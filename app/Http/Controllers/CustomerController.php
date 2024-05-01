<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customer = Customer::with('user')->latest()->get();

        return view('admin.usersCustomer.index',[
            'customers' => $customer
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = Customer::with('user')->latest()->get();

        // dd($customer->toArray());

        return view('admin.usersCustomer.createForm', [
            'customers' => $customer
        ]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request);

        $validator = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['email', 'required','unique:users,email'],
            'password' => ['required', 'min:8'],
            'phone' => ['required','string'],
            'address' => ['required', 'string']
        ]);

        $userNew = User::create([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => bcrypt($validator['password']),
            'isAdmin' => false
        ]);

        Customer::create([
            'user_id' => $userNew->id,
            'phone' => $validator['phone'],
            'address' => $validator['address']
        ]);

        return redirect()->route('customer.index')->with('success','Customer Berhasil Ditambahkan');


    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $customer = Customer::with('user')->find($id);

        return view('admin.usersCustomer.editForm',[
            'customers' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer, $id)
    {
        $customer = Customer::with('user')->find($id);

        $validator = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['email', 'required', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string']
        ]);

        $customer->user->update([
            'name' => $validator['name'],
            'email' => $validator['email'],
            'password' => bcrypt($validator['password']),
        ]);

        $customer->update([

            'phone' => $validator['phone'],
            'address' => $validator['address']
        ]);


        return redirect()->route('customer.index')->with('success', 'Customer Berhasil Diedit!');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer,$id)
    {
        $customer = Customer::with('user')->find($id);

        $customer->delete();

        $customer->user->delete();

        return redirect()->route('customer.index')->with('success', 'Customer Berhasil Dihapus');

    }
}
