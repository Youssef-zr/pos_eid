<?php

namespace App\Http\Requests\category;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = RuleFactory::make([
            '%name%' => "required|string|unique:category_translations,name"
        ]);

        $method = strtolower(request()->method());
        if ($method == "patch") {
            $rules = RuleFactory::make([
                '%name%' => "required|string|unique:category_translations,name," . $this->category->id . ",id"
            ]);
        }

        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            "ar.name" => 'الاسم باللغة العربية',
            "en.name" => 'الاسم باللغة الانجليزية',
        ];

        return $attributes;
    }
}
