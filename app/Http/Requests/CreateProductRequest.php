<?php

namespace App\Http\Requests;

use App\DTO\Creators\ProductDTOFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'available' => 'boolean',
            'image' => 'nullable|file|mimes:png,jpg,jpeg',
            'category_id' => 'nullable|exists:categories,id'
        ];
    }

    public function toDTO(): \App\DTO\ProductDTO
    {
        return ProductDTOFactory::create
        (
            $this->input('name'),
            $this->input('price'),
            $this->input('description'),
            $this->input('available'),
            $this->file('image'),
            $this->input('category_id'),

        );
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
