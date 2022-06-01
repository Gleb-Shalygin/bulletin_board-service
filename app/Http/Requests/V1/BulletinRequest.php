<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class BulletinRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:200',
            'price' => 'required|numeric|lt:100000.00',
            'description' => 'required|max:1000',
            'general_photo' => 'string',
            'photos' => 'array|max:3'
        ];
    }
}
