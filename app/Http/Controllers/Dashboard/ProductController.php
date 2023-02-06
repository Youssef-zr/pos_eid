<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\UploadFiles;
use Astrotomic\Translatable\Locales;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Lang;

class ProductController extends Controller
{
    use UploadFiles;

    public function __construct()
    {
        $this->middleware(['permission:read_products'])->only(['index']);
        $this->middleware(['permission:create_products'])->only(['create', 'store']);
        $this->middleware(['permission:update_products'])->only(['edit', 'update']);
        $this->middleware(['permission:delete_products'])->only(['destroy']);
    }

    public function index($id = null)
    {
        $title = trans("lang.products_list");
        $products = [];

        if ($id != null) {

            $title = trans("lang.related_products");
            $products = Product::where('category_id', $id)->get();
        } else {

            $products = Product::all();
        }

        return view("dashboard.views.products.index", compact('title', "products"));
    }

    public function create()
    {
        $title = trans('lang.products_new');
        $locale_langs = app(Locales::class)->all();

        $lang = app()->getLocale();
        $categories = Category::translatedIn($lang)->get()
            ->pluck("name", "id")->toArray();

        return view('dashboard.views.products.create', compact('title', "categories", "locale_langs"));
    }

    public function store(ProductRequest $request)
    {
        $data = Arr::except($request->all(), ['photo']);

        $new = new Product();
        $new->fill($data)->save();

        if ($request->hasFile("photo")) {

            $photo = $request->file('photo');
            $storagePath = "assets/dist/storage/products";
            $photoProps = [
                'file' => $photo,
                'storagePath' => $storagePath,
                "width" => 350,
                "quality" => 80
            ];

            $fileInformation = UploadFiles::storeFile($photoProps);
            $new->fill(['photo' => $fileInformation['file_path']])->save();
        }

        return redirect_with_flash("msgSuccess", trans("lang.record_updated_successfully"), "products");
    }

    public function edit(Product $product)
    {
        $title  = trans("lang.products_update");
        $locale_langs = app(Locales::class)->all();

        $localeTrans = app()->getLocale();
        $categories = Category::withTranslation($localeTrans)->get()
            ->pluck('name', "id")->toArray();

        return view("dashboard.views.products.update", compact("title", "product", "categories", "locale_langs"));
    }

    public function update(ProductRequest $request, Product $product)
    {
        $data = Arr::except($request->all(), ['photo']);
        $product->fill($data)->save();

        if ($request->hasFile("photo")) {

            $file = $request->file('photo');
            $storagePath = "assets/dist/storage/products";
            $oldFile = $product->photo;
            $default = $oldFile;

            $imgProp = [
                'file' => $file,
                "storagePath" => $storagePath,
                "old_image" => $oldFile,
                "default" => $default,
                "width" => 350,
                "quality" => 80
            ];

            $fileInformation = UploadFiles::updateFile($imgProp);
            $product->fill(['photo' => $fileInformation['file_path']])->save();
        }

        return redirect_with_flash("msgSuccess", trans("lang.record_updated_successfully"), "products");
    }

    public function destroy(Product $product)
    {
        $imgProps = [
            'old_image' => $product->photo,
            'default' => $product->photo,
        ];

        UploadFiles::removeFile($imgProps);

        $product->delete();

        return redirect_with_flash("msgSuccess", trans("lang.record_deleted_successfully"), "products");
    }
}
