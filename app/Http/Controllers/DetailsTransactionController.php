<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\DetailsTransaction;
use App\Models\EvidencePayment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class DetailsTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function details(Request $request)
    {
        $DetailTransaction = Transaction::with(['detailtransaction', 'evidencepayment' => function($builder) {
            $builder->latest();
        } ])
        ->where('customer_id', Customer::where('user_id', $request->user()->id)->first()->id)
        ->get()
        ->map( function($item) {
            $totalPrice = 0;
            $totalQty = 0;
            foreach($item->detailtransaction as $detail){
                $totalPrice += $detail->qty * $detail->price;
                $totalQty += $detail->qty;
            } 

            $item->totalPrice = $totalPrice;
            $item->totalQty = $totalQty;

            // $item->status = $item->evidencepayment->isEmpty();

            if($item->evidencepayment->isEmpty())
            {
                $item->status = 'Belum Bayar';
            } else if (is_null($item->evidencepayment[0]->status)) {
               $item->status = 'Diproses';
            } else if ($item->evidencepayment[0]->status) {
                $item->status = 'Berhasil';
            } else {
                $item->status = 'Ditolak';

            } 
            return $item;
        });

        // dd($DetailTransaction->toArray());
        return view('home.Orders' , [
            'details' => $DetailTransaction
        ]);
    }

    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());

            $image = $request->file('url');
            $imageName = Str::random(10) . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images-product/' . $imageName;
            Storage::disk('public')->put($imagePath, file_get_contents($image));

        EvidencePayment::create([
            'transaction_id' => $request->transaction_id,
            'url' => $imagePath
        ]);

        return redirect()->route('detailsOrder');
    }

    /**
     * Display the specified resource.
     */
    public function show(DetailsTransaction $detailsTransaction, $id)
    {
        
        return view('home.evidence', [
            'transaction_id' => $id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailsTransaction $detailsTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DetailsTransaction $detailsTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailsTransaction $detailsTransaction)
    {
        //
    }
}
