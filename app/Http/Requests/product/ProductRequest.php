<?php

namespace App\Http\Requests\product;

use Astrotomic\Translatable\Locales;
use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id' => "required|numeric",
            "%title%" => "required|string|unique:product_translations,title",
            "%description%" => "required|string",
            "photo" => "nullable|image|mimes:png,jpg,jpeg,gif",
            "purchase_price" => "required|numeric",
            "sale_price" => "required|numeric",
            "stock" => "required|numeric",
        ]);

        $method = strtolower(request()->method());
        if ($method == "patch") {
            $localeLangs = app(Locales::class)->all();
            foreach ($localeLangs as $locale) {
                $rules[$locale . '.title'] = 'required|string|unique:product_translations,title,' . $this->product->id . ',product_id';
            }
        }


        return $rules;
    }

    public function attributes()
    {
        $attributes = [
            'category_id' => trans("lang.category"),
            'purchase_price' => trans("lang.purchase_price"),
            'sale_price' => trans("lang.sale_price"),
            'stock' => trans("lang.stock"),
            'photo' => trans("lang.image"),
            'ar.title' => trans("lang.ar.title"),
            'en.title' => trans("lang.en.title"),
            'ar.description' => trans("lang.ar.description"),
            'en.description' => trans("lang.en.description"),
        ];

        return $attributes;
    }
}
