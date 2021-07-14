<?php

namespace App\Http\Requests;

use App\Box;
use Illuminate\Foundation\Http\FormRequest;

class BoxEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $min = Box::count() + 1;
        $box_total = request()->box_total;
        return [
            'name' => 'required|string',
            'image' => 'required|image',
            'box_total' => 'required|numeric',
            'amount' => 'required|numeric',
            'box_id' => 'required|numeric|min:1|max:'.$box_total,
            'prize' => 'required|string',
            'giftcode' => 'required|string',
            'hdsd' => 'required|string',
        ];
    }
}
