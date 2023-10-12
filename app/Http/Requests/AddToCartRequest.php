<?php

namespace App\Http\Requests;

use App\DTO\CartItemDTO;
use App\DTO\Creators\CartItemDTOFactory;
use App\DTO\Creators\ProductDTOFactory;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddToCartRequest extends FormRequest
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
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|min:1',
        ];
    }

    public function toDTO(): \App\DTO\CartItemDTO
    {
        return CartItemDTOFactory::create
        (
            $this->user()->id,
            $this->input('product_id'),
            $this->input('quantity'),
        );
    }

    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
