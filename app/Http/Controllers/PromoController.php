<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $promo = Promo::with('product.productpictures')->latest()->get();

        // dd($promo->toArray());

        return view('admin.promos.index', [
            'promos' => $promo
        ]);
    }

    public function getProdNoProm(Request $request)
    {
        // dd($request->all());
        $date = Product::whereDoesntHave('promo', function ($builder) use($request) {
            $builder->where('startdate', '<=', $request->start_date)
            ->where('enddate', '>=', $request->start_date)
            ->orWhere('startdate', '<=', $request->end_date)
            ->where('enddate', '>=', $request->end_date);
        })->where('id',$request->product_id)->exists();

        // dd($date);

        if(!$date) {
            return redirect()->back()->withInput()->withErrors(['Rentang Waktu Produk Tumpang Tindih']);
        } 
        
        Promo::create([
            'product_id' => $request->product_id,
            'promo_discount' => $request->discount,
            'startdate' => $request->start_date,
            'enddate' => $request->end_date
        ]);

        return redirect()->route('promo.index');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $promo = Promo::with('product.productpictures')->latest()->get();
        $product = Product::with('productpictures')->latest()->get();
        
        // dd($promo->toArray());
        return view('admin.promos.createForm',[
            'promos' => $promo,
            'products' => $product
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $start_date = $request->input('start_date');
        // $end_date = $request->input('end_date');
        // dd($request->all());

        // dd($request->all());


        $validator = $request->validate([

            'product_id' => ['required'],
            'discount' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date']

        ]);

        // dd($validator);
        // dd($request->toArray());

        $promo = Promo::create([

            'product_id' => $validator['product_id'],
            'promo_discount' => $validator['discount'],
            'startdate' => $validator['start_date'],
            'enddate' => $validator['end_date']

        ]);

        return redirect()->route('promo.index')->with('success','Data Promo berhasil ditambah');

    }

    /**
     * Display the specified resource.
     */
    public function show(Promo $promo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promo $promo)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promo $promo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promo $promo)
    {
        //
    }
}
