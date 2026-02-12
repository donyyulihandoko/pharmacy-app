<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class StoreCategoryRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'min:3', 'max:255', Rule::unique('categories', 'name')],
            'icon' => ['required', 'image', 'mimes:png,jpg,jpeg,svg', 'max:2000'],
            'description' => ['required', 'max:255', 'string'],
            'is_active' => ['sometimes', 'boolean']
        ];
    }
}
