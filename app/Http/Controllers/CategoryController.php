<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request) 
    {
        if (!$request->user()->isAdmin) {
            abort(403);
        }
        
        $category = Category::query()->latest()->get();

        return view('admin.category.index', [
            'category' => $category
        ]);
    }

    public function create()

    {
        $category = Category::query()->latest()->get();
        // dd($category->toArray());

        return view('admin.category.createForm', [
            'category' => $category
        ]);
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.category.editForm', compact('category'));

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string'
        ]);

        if ($validator->fails())
        return redirect()->back()->withInput()->withErrors($validator);

        $storeData = Category::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Merek berhasil dibuat!');

        return redirect()->route('category.index');
    }

    public function update(Request $request,$id)
    {
        $category = Category::find($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id, // Exclude current brand ID for uniqueness validation
        ]);

        $category->update($request->all());

        session()->flash('success','Category berhasil ditambahkan!');

        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        $category->delete();

        session()->flash('success', 'Categories berhasil dihapus!');

        return redirect()->route('category.index');
    }

    
}
