<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index() 
    {
        $dataPelaggan = Customer::count();
        $products = Product::count();
        $transactions = Transaction::count(); //semua
        $OrderDone = Transaction::whereRelation('evidencepayment', 'status', true)->count(); //berhasil
        $OrderIn = Transaction::WhereRelation('evidencepayment','status', null)->count(); //diproses
        $OrderDecline = Transaction::with(['evidencepayment' => function ($builder) { //ditolak
            $builder->latest();
        }])->get();
        
        $num = 0;
        foreach($OrderDecline as $dec){
            if(!$dec->evidencepayment[0]->status){
                $num++;
            }
        }

        // dd($num);
        


        return view('admin.dashboard.index', [
            'dataPelanggan' => $dataPelaggan,
            'products' => $products,
            'transaction' => $transactions,
            'orderDone' => $OrderDone,
            'orderIn' => $OrderIn,
            'orderDecline' => $num

        ]);
    }


}
