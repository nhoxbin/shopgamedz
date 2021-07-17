<?php

namespace App\Http\Controllers\Admin;

use App\Box;
use App\BoxEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\BoxEventRequest;

class BoxEventController extends Controller
{
    public function random($length = 10) {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

    public function listBoxes() {
        $boxes = Box::where('user_id', '!=', null)->orderBy('updated_at', 'desc')->get();
        return view('admin.boxes', compact('boxes'));
    }

    public function index() {
        $bEvent = BoxEvent::all();
        return view('admin.box-event', compact('bEvent'));
    }

    public function store(BoxEventRequest $request) {
        if (!$request->ajax()) {
            return response(null, 400);
        }
        if (!$request->hasFile('image') && !$request->image->isValid()) {
            return response('file ko đúng định dạng!', 500);
        }
        $url = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move('uploads', $url);
        try {
            $validated = $request->validated();
            $validated['chars'] = $this->random();
            $validated['box_id'] = Box::count() + $request->box_id;
            $validated['image'] = $url;
            $event = BoxEvent::create($validated);

            $boxes = [];
            for ($i=0; $i < $request->box_total; $i++) {
                array_push($boxes, [
                    'stt' => $i+1,
                    'box_event_id' => $event->id,
                    "created_at" =>  \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]);
            }
            Box::insert($boxes);
            $msg = 'ok';
        } catch(\Exception $e) {
            $msg = env('APP_DEBUG') ? $e->getMessage() : 'Có lỗi xảy ra!';
        }

        return response($msg, 201);
    }

    public function update(BoxEventRequest $request, BoxEvent $boxEvent) {
        $boxEvent->update($request->validated());
        return response('ok', 200);
    }

    public function destroy(BoxEvent $boxEvent) {
        $boxEvent->delete();
        return response('ok', 200);
    }
}
