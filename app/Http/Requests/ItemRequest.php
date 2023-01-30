<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use \Illuminate\Validation\Rule;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'code' => 'unique:items,code,'.$this->id,
            'code' => [
                'required',
                Rule::unique('items')->ignore($this->item)
            ],
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'numeric|min:0',
        ];
    }
}
