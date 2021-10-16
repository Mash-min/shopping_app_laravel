<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function PHPSTORM_META\map;

class AddProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'category' => 'required',
            'stock' => 'required|numeric',
            'refund' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Product name is required',
            'description.required' => 'Product description is required',
            'price.required' => 'Product price is required',
            'price.numeric' => 'Invalid product price',
            'discount.required' => 'Product discount is required',
            'discount.numeric' => 'Invalid product discount',
            'stock.required' => 'Product stock is required',
            'stock.numeric' => 'Invalid product stock',
            'refund.required' => 'Days of product refund is required',
            'refund.required' => 'Invalid product refund'
        ];
    }
}
