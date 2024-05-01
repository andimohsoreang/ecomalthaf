<?php

namespace App\Http\Controllers;

use App\Models\EvidencePayment;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $DetailTransaction = Transaction::with(['detailtransaction', 'evidencepayment' => function ($builder) {
            $builder->latest();
        }])
            ->get()
            ->map(function ($item) {
                $totalPrice = 0;
                $totalQty = 0;
                foreach ($item->detailtransaction as $detail) {
                    $totalPrice += $detail->qty * $detail->price;
                    $totalQty += $detail->qty;
                }

                $item->totalPrice = $totalPrice;
                $item->totalQty = $totalQty;

                // $item->status = $item->evidencepayment->isEmpty();

                if ($item->evidencepayment->isEmpty()) {
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

        return view('admin.order.index', [
            'data' => $DetailTransaction
        ]);
    }

    public function updateStatus(Request $request)
    {

        EvidencePayment::where('transaction_id', $request->transaction_id)
        ->latest()
        ->first()
        ->update(['status' => $request->status,'reason' => $request->reason]);

        return redirect()->route('order.index');
        // dd($request->all());




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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction, $id)
    {

        $transaction = Transaction::with(['customer.user', 'detailtransaction.product.subcategory.category', 'evidencepayment' => function ($builder) {
            $builder->latest();
        }])->find($id);

        $totalPrice = 0;
        foreach ($transaction->detailtransaction as $i) {

            $totalPrice += $i->price * $i->qty;

        }


        // dd($transaction->toArray());
            return view('admin.order.showForm', [
                'order' => $transaction,
                'totalPrice' => $totalPrice
            ]);
    }


    public function indexDone() {

        $DetailTransaction = Transaction::with(['detailtransaction', 'evidencepayment' => function ($builder) {
            $builder->latest();
    }]) ->whereRelation('evidencepayment', 'status', true)
            ->get()
            ->map(function ($item) {
                $totalPrice = 0;
                $totalQty = 0;
                foreach ($item->detailtransaction as $detail) {
                    $totalPrice += $detail->qty * $detail->price;
                    $totalQty += $detail->qty;
                }

                $item->totalPrice = $totalPrice;
                $item->totalQty = $totalQty;

                // $item->status = $item->evidencepayment->isEmpty();

                if ($item->evidencepayment->isEmpty()) {
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

        return view('admin.order.orderDone', [
            'data' => $DetailTransaction
        ]);

    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
