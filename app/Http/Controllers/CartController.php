<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\DetailsTransaction;
use App\Models\Product;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

 

class CartController extends Controller
{


    public function noLogin(Request $request)
    {

        // dd(Auth::check());
        if (!Auth::check()) {
            return redirect()->route('login');
        }


        $customer = Customer::where('user_id', $request->user()->id)->first();

        $check = Cart::where('customer_id', $customer->id)->where('product_id', $request->product_id)->exists();


        if (!$check) {
            Cart::create([
                'customer_id' => $customer->id,
                'product_id' => $request->product_id
            ]);
        }


        return redirect()->route('carts');
    }

    public function carts(Request $request)
    {
        $customer = Customer::where('user_id', $request->user()->id)->first();

        $cart = Cart::with(['product.productpictures',  'product.promo' => function ($builder) {
            $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
        }])->where('customer_id', $customer->id)->get()->map(
            function ($item) {
                if(!$item->product->promo->isEmpty()){
                    $item->product->price = $item->product->price - $item->product->price * $item->product->promo[0]->promo_discount / 100;
                }

                return $item;

            }
        );


        return view('home.cart', [

            'carts' => $cart
        ]);
    }


    public function checkout(Request $request)
    {
        // dd($request->all());
        $productCart = Cart::with(['product.promo'=> function ($builder) {
            $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
        }, 'customer.user'])->get();
        
        $productQtys = $request->input('product_qty');
        // dd($productQtys);

        // dd($productCart->toArray()); // Ini hanya untuk keperluan debugging

        $data = [];
        $grandTotal = 0;
        foreach ($productCart as $product) {
            // var_dump($product->id);
            $qty = isset($productQtys[$product->product->id]) ? $productQtys[$product->product->id] : 0;
            $totalPrice = $product->product->price * $qty; // Menghitung total harga produk

            if($product->product->promo->isEmpty()){
                $totalPrice = $product->product->price * $qty; // Menghitung total harga produk

            } else {

                $totalPrice = ($product->product->price - $product->product->price * $product->product->promo[0]->promo_discount / 100) * $qty; // Menghitung total harga produk


            }

            $data[$product->id] = [
                'products' => $product,
                'qty' => $qty,
                'totalPrice' => $totalPrice, // Menambahkan total harga ke dalam array data
            ];

            $grandTotal += $totalPrice; // Menambahkan total harga produk ke grand total
        }

        // dd($data);

        return view('home.checkout', [
            'products' => $productCart,
            'qtys' => $productQtys,
            'data' => $data,
            'grandTotal' => $grandTotal
        ]);
    }




    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, )
    {

        
        $customerId = Customer::where('user_id',$request->user()->id)->first();

        function generateInvoiceNumber()
        {
            // Definisikan pola nomor invoice Anda di sini, misalnya INV-{tahun}-{bulan}-{nomor acak}
            $pattern = 'INV-' . date('Y') . '-' . date('m') . '-' . mt_rand(1000, 9999);
            return $pattern;
        }

        $invoiceNumber = generateInvoiceNumber();

        DB::transaction(function () use($customerId, $invoiceNumber, $request) {
            
            $transactions = Transaction::create([
                'customer_id' => $customerId->id,
                'numinvoice' => $invoiceNumber
            ]);
    
            foreach($request->qty as $key => $value)
            {
                DetailsTransaction::create([
                    'transaction_id' => $transactions->id,
                    'product_id' => $key,
                    'qty' => $value,
                    'price' => $request->price[$key]
                ]);
            }   
    
    
            Cart::where('customer_id',$customerId->id)->delete();
        });

            
        
        return redirect()->route('detailsOrder');




        // dd($transaction);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
