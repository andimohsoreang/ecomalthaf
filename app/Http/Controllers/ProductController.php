<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPictures;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class ProductController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->user()->isAdmin) {
            abort(403);
        }

        $product = Product::with(['subcategory.category','productpictures'])->latest()->get();

        // dd($product->toArray());
        

        // dd($product->toArray());
        return view('admin.product.index',[
            'products' => $product,
            
        ]);
    }

    public function create()
    {

        // $product = Product::with('subcategory.category')->latest()->get();
        $category = Category::query()->latest()->get();
        $brand = Brand::query()->latest()->get();

        // dd($brand->toArray());
        // dd($product->toArray());
        return view('admin.product.createForm',[
            
            'categories' => $category,
            'brands' => $brand
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->toArray());
        $validator = $request->validate([

            'subcategory_id' =>['required'],
            'brand_id' => ['required', 'string'], 
            'productcode' => ['required','string'],
            'productname'=> ['required', 'min:3', 'max:255', 'string'],
            'productweight' => ['required', 'min:3', 'max:255', 'string',],
            'stock' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'desc' => ['required', 'string'],
            'url' => ['required', 'array', 'min:1'],
            'url.*' => ['image', 'mimes:jpeg,png,jpg','max:2048']
        ]);


        $product = Product::create([
            'subcategory_id' => $validator['subcategory_id'],
            'productcode' => $validator['productcode'],
            'brand_id' => $validator['brand_id'],
            'productname' => $validator['productname'],
            'productweight' => $validator['productweight'],
            'stock' => $validator['stock'],
            'price' => $validator['price'],
            'desc' => $validator['desc'],
            
        ]);

    
            $images = $request->file('url');
            foreach ($images as $image) {
                $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = 'images-product/' . $imageName;
                Storage::disk('public')->put($imagePath, file_get_contents($image));

                ProductPictures::create([
                    'product_id' => $product->id,
                    'url' => $imagePath
                ]);
            }
        


        return redirect()->route('product.index')->with('success', 'Produk Berhasil ditambahkan');
    }


    public function edit($id) 
    {
        $category = Category::query()->latest()->get();
        $product = Product::with(['subcategory.category', 'productpictures'])->find($id);
        $brand = Brand::query()->latest()->get();

        return view('admin.product.editForm', [
            'products' => $product,
            'categories' => $category,
            'brands' => $brand
        ]);
    
    }

    public function update(Request $request, $id)
    {


        $validator = $request->validate([

            'subcategory_id' => ['required'],
            'brand_id' => ['required', 'string'],
            'productcode' => ['required', 'string'],
            'productname' => ['required', 'min:3', 'max:255', 'string'],
            'productweight' => ['required', 'min:3', 'max:255', 'string',],
            'stock' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'desc' => ['required', 'string'],
            'url' => ['required', 'array', 'min:1'],
            'url.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);



        $product = Product::with(['subcategory.category', 'productpictures'])->find($id);

        
       
        foreach ($product->productpictures as $image) {

            $imagePath = $image->url;

            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $image->delete();

        }

        $product->update([
            'subcategory_id' => $validator['subcategory_id'],
            'productcode' => $validator['productcode'],
            'brand_id' => $validator['brand_id'],
            'productname' => $validator['productname'],
            'productweight' => $validator['productweight'],
            'stock' => $validator['stock'],
            'price' => $validator['price'],
            'desc' => $validator['desc'],
        ]);


        $images = $request->file('url');
        foreach ($images as $image) {
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images-product/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));

            ProductPictures::create([
                'product_id' => $product->id,
                'url' => $imagePath
            ]);
        }

        return redirect()->route('product.index')->with('success','Data Diubah');
        

    }


    public function destroy($id) 
    {

        $product = Product::with(['productpictures','promo'])->find($id);

        
        foreach ($product->productpictures as $image) {

            $imagePath = $image->url;

            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            $image->delete();
        }

        foreach($product->promo as $promo) {
            $promo->delete();
        }
        $product->delete();

        return redirect()->route('product.index')->with('success','Data di Hapus');
    }
    



    public function fetchSubcategories(Request $request)
    {
        $categoryId = $request->input('category_id');
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }
}
