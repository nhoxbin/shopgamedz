<?php

namespace App\Http\Controllers;

use App\Box;
use App\BoxEvent;
use Illuminate\Http\Request;

class BoxEventController extends Controller
{
    public function instruction() {
        return view('box-event-instruction');
    }

    public function index() {
        $events = BoxEvent::all();
        $events_end = BoxEvent::whereHas('boxes', function($q) {
            $q->where('user_id', '!=', null);
        })->get();
        return view('box-event', compact('events', 'events_end'));
    }

    public function show(BoxEvent $boxEvent) {
        $unbox = Box::where('user_id', '!=', null)->get();
        return view('boxes', compact('boxEvent', 'unbox'));
    }

    public function update(Request $request) {
        $box = Box::find($request->box_id);
        if (!empty($box->user_id)) return response('Rương này đã có người mở!');
        if ($request->user()->cash - $box->box_event->amount < 0) return response('Bạn không đủ tiền mở rương!');

        $request->user()->cash -= $box->box_event->amount;
        $request->user()->save();

        $box->user_id = $request->user()->id;
        $box->save();
        return response('true');
    }
}
