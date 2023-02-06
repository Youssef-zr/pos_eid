<?php

namespace App\Http\Requests\role;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'name' => "required|string|unique:roles,name",
            'description' => "sometimes|nullable|string|max:255",
            'permissions' => 'sometimes|nullable|array'
        ];

        $method = strtolower(request()->method());
        if ($method == "patch") {
            $rules['name'] = "required|string|unique:roles,name," . $this->role->id;
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'name' => trans("lang.role_name2"),
            'description' => trans("lang.description"),
            'permissions' => trans('lsng.permissions')
        ];

        return $attributes;
    }
}
