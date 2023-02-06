<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class ClientOrderRequest extends FormRequest
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
            "products" => "required|array",
        ];
    }

    public function attributes()
    {
        return [
            "products" => trans("lang.products"),
        ];
    }
}
