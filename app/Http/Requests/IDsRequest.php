<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IDsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:256',
            'sinner_id' => 'required',
            'association_id' => 'required',
            'description' => 'nullable',
            'price' => 'nullable|numeric',
            'year' => 'numeric',
            'image' => 'nullable|image',
            'display' => 'nullable',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'name',
            'sinner_id' => 'Sinners',
            'association_id' => 'association',
            'description' => 'description',
            'price' => 'price',
            'year' => 'year',
            'image' => 'image',
            'display' => 'display',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'field ":attribute" is mandatory',
            'min' => 'field ":attribute" has to be at least :min symbols long',
            'max' => 'field ":attribute" cannot be longer than :max symbols',
            'boolean' => 'field ":attribute" value must be "true" or "false"',
            'unique' => 'field ":attribute" value is already registered',
            'numeric' => 'field ":attribute" value must be a number',
            'image' => 'field ":attribute" add a correct image file',
        ];
    }
}