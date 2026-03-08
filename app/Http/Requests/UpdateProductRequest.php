<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
        $product = $this->route('product');
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                Rule::unique('products', 'name')->ignore($product?->id)
            ],
            // 'slug' => ['required', 'string', Rule::unique('products', 'slug')],
            'image' => [
                'nullable',
                'image',
                'mimes:png,jpg,jpeg,svg',
                'max:2048',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'about' => [
                'required',
                'max:2000',
                'string'
            ],
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id'
            ],
        ];
    }
}
