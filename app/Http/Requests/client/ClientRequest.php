<?php

namespace App\Http\Requests\client;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string',
            'phone' => 'required|nullable|digits:10',
            'adress' => 'sometimes|nullable|string',
            "email" => 'sometimes|nullable|email|unique:clients,email'
        ];

        $method = strtolower(request()->method());
        if ($method == "patch") {
            $rules['email'] = "sometimes|nullable|unique:clients,email," . $this->client->id;
        }

        return $rules;
    }

    public function attributes()
    {

        $attributes = [
            'name' => trans('lang.name'),
            'adress' => trans('lang.adress'),
            'phone' => trans('lang.phone'),
            "email" => trans('lang.email')
        ];

        return $attributes;
    }
}
