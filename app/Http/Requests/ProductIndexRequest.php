<?php

namespace App\Http\Requests;

use App\DTO\Creators\ProductFilterDTOFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductIndexRequest extends FormRequest
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
            'filters'=> 'nullable|array',
            'filters.name' => 'string|max:255',
            'filters.min_price' => 'numeric',
            'filters.max_price' => 'numeric',
            'filters.description' => 'nullable|string',
            'filters.available' => 'boolean',
            'filters.category_id' => 'nullable'
        ];
    }

    public function toDTO(): \App\DTO\ProductFilterDTO
    {
        return ProductFilterDTOFactory::create
        (
            $this->input('filters.name'),
            $this->input('filters.min_price'),
            $this->input('filters.max_price'),
            $this->input('filters.description'),
            $this->input('filters.available'),
            $this->input('filters.category_id'),

        );
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
