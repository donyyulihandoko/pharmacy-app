<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $category = $this->route('category');
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('categories', 'name')->ignore($category?->id)
            ],
            // 'slug' => [
            //     'required',
            //     'string',
            //     Rule::unique('categories', 'slug')->ignore($category?->id)
            // ],
            'icon' => [
                'nullable',
                'image',
                'mimes:png,jpg,jpeg,svg',
                'max:2048',
            ],
            'description' => [
                'required',
                'max:1000',
                'string'
            ],
            'is_active' => [
                'sometimes',
                'boolean'
            ]

        ];
    }
}
