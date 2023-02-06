<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'adress' => 'sometimes|nullable|string',
            'phone' => 'required|numeric|digits:10|unique:users,phone',
            'password' => 'required|same:confirm-password',
            'status' => 'required',
            'role' => 'required|numeric',
        ];

        $method = strToLower(request()->method());
        if ($method == "patch") {
            $rules['password'] = 'sometimes|nullable';
            $rules['email'] = 'required|email|unique:users,email,' . $this->user;
            $rules['phone'] = 'required|nullable|numeric|digits:10|unique:users,phone,' . $this->user;
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'name' => trans("lang.name"),
            'email' => trans("lang.email"),
            'adress' => trans("lang.adress"),
            'phone' => trans("lang.phone"),
            'password' => trans("lang.password"),
            'confirm-password' => trans("lang.confirm-password"),
            'status' => trans("lang.status"),
            'role' => trans("lang.role"),
        ];

        return $attributes;
    }
}
