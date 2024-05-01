<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        if(!$request->user()->isAdmin)
        {
            abort(403);
        }

        $brands = Brand::query()->latest()->get();

       return view('admin.brand.index', [
        'brands' => $brands
       ]);
    }


    public function create()
    {
        return view('admin.brand.createForm');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(),[
            'brandname' => 'required|string'
        ]);

        if($validator->fails())
        return redirect()->back()->withInput()->withErrors($validator);

        $storeData = Brand::create([
            'brandname' => $request->brandname
        ]);

        session()->flash('success', 'Merek berhasil dibuat!');
       
        return redirect()->route('brand.index');

    }

    public function edit($id)
    {
        $brand = Brand::find($id);

        return view('admin.brand.editForm',compact('brand'));
    }

    public function update(Request $request, $id)
    {

        $brand = Brand::find($id);

        $request->validate([
            'brandname' => 'required|string|max:255|unique:brands,brandname,' . $brand->id, // Exclude current brand ID for uniqueness validation
        ]);

        $brand->update($request->all());

        session()->flash('success', 'Merek berhasil diubah!');

        return redirect()->route('brand.index');

    }


    public function destroy($id) 
    {
        $brand = Brand::find($id);

        $brand->delete();

        session()->flash('success', 'Merek berhasil dihapus!');

        return redirect()->route('brand.index');
    }


}
