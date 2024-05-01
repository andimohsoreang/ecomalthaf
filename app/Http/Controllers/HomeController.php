<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Home;
use App\Models\Product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function landingpage()
    {
        $productsPromo = Product::with(['productpictures', 'promo' => function ($builder) {
            $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
        }])->whereRelation('promo', function ($builder) {
            $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
        })->latest()->get();

        $products = Product::with(['productpictures', 'promo' => function ($builder) {
            $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
        }])->latest()->limit(3)->get();



        return view('home.index', [
            'products' => $products,
            'productsPromo' => $productsPromo
        ]);
    }

    public function promo(Request $request)
    {

        if (!is_null($request->category_id)) {

            $products = Product::with(['productpictures', 'promo' => function ($builder) {
                $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
            }])->whereRelation('subcategory.category', 'id', $request->category_id)->whereRelation('promo', function ($builder) {
                $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
            })->latest()->get();
        } else if (!is_null($request->subcategory_id)) {

            $products = Product::with(['productpictures', 'promo' => function ($builder) {
                $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
            }])->whereRelation('subcategory', 'id', $request->subcategory_id)->whereRelation('promo', function ($builder) {
                $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
            })->latest()->get();
        } else {

            $products = Product::with(['productpictures', 'promo' => function ($builder) {
                $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
            }])->whereRelation('promo', function ($builder) {
                $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
            })->latest()->get();
        }

        $product = $products->map(function ($item) {
            $item->discountprice = $item->price - ($item->price * $item->promo[0]->promo_discount / 100);

            return $item;
        });

        // dd($product->toArray());

        $subcategories = Subcategory::query()->latest()->get();
        $categories = Category::with('subcategory')->latest()->get();
        // dd($promo->toArray());

        return view('home.promo', [
            // 'promo' => $products,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'productDiscount' => $product
        ]);
    }




    public function index(Request $request)
    {
        // dd(Carbon::now());
        if (!is_null($request->category_id)) {

            $products = Product::with(['productpictures', 'promo' => function ($builder) {
                $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
            }])->whereRelation('subcategory.category', 'id', $request->category_id)->latest()->get();
        } else if (!is_null($request->subcategory_id)) {

            $products = Product::with(['productpictures', 'promo' => function ($builder) {
                $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
            }])->whereRelation('subcategory', 'id', $request->subcategory_id)->latest()->get();
        } else {

            $products = Product::with(['productpictures', 'promo' => function ($builder) {
                $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
            }])->latest()->get();
        }

        // dd($products->toArray());


        $subcategories = Subcategory::query()->latest()->get();
        $categories = Category::with('subcategory')->latest()->get();

        return view('home.shop', [
            'categories' => $categories,
            'subcategories' => $subcategories,
            'products' => $products
        ]);
    }


    public function showProducts($id)
    {

        $products = Product::with(['productpictures', 'subcategory.category', 'promo' => function ($builder) {
            $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
        }])->find($id);

        if (!$products->promo->isEmpty()) {
            $products->discountprice = $products->price - ($products->price * $products->promo[0]->promo_discount / 100);
        }

        // dd($products->toArray());
        return view('home.showProducts', [
            'products' => $products
        ]);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
    }
}
