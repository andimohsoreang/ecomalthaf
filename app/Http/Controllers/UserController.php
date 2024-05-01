<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $productsPromo = Product::with(['productpictures', 'promo' => function ($builder) {
            $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
        }])->whereRelation('promo', function ($builder) {
            $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
        })->latest()->get();

        $products = Product::with(['productpictures', 'promo' => function ($builder) {
            $builder->where('startdate', '<=', Carbon::now())->where('enddate', '>=', Carbon::now());
        }])->latest()->limit(3)->get();

        if (!$request->user()->isAdmin) {

            $user = User::where('isAdmin', true)->latest()->get();


            return view('home.index', [
                'users' => $user,
                'products' => $products,
                'productsPromo' => $productsPromo
            ]);
        }

        $user = User::where('isAdmin', true)->latest()->get();

        return view('admin.usersAdmin.index', [
            'users' => $user,
            
        ]);
    }

    public function create()
    {
        return view('admin.usersAdmin.createForm');
    }

    public function store(Request $request)
    {
        $user = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['email', 'required'],
            'password' => ['required', 'min:8']
        ]);

        User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => bcrypt($user['password'])
        ]);

        return redirect()->route('user.index')->with('success', 'User Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $users = User::find($id);


        return view('admin.usersAdmin.editForm', [
            'users' => $users
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $validator = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['email', 'required'],
            'password' => ['required', 'min:8']
        ]);

        $user->update($validator);

        return redirect()->route('user.index')->with('success', 'User Diupdate!');
    }

    public function destroy($id)
    {

        $user = User::find($id);

        $user->delete();

        return redirect()->route('user.index')->with('success', 'User Dihapus!');
    }
}
