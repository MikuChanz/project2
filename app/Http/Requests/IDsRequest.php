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
            'rarity' => 'required',
            'season' => 'nullable|string|max:64',
            'release_year' => 'numeric',
            'image' => 'nullable|file|mimes:png,jpg,jpeg,webp',
            'display' => 'nullable',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'identity name',
            'sinner_id' => 'sinner',
            'association_id' => 'association',
            'description' => 'description',
            'rarity' => 'rarity',
            'season' => 'season',
            'release_year' => 'release year',
            'image' => 'image',
            'display' => 'publish',
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