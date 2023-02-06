<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email,' . $this->user,
            'phone' => 'required|nullable|numeric|digits:10|unique:users,phone,' . $this->user,
            'photo' => "sometimes|nullable|image|mimes:jpg,png,jpeg,gif,svg",
        ];

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'name' => trans('lang.name'),
            'phone' => trans('lang.phone'),
            'photo' => trans('lang.photo'),
        ];

        return $attributes;
    }
}
