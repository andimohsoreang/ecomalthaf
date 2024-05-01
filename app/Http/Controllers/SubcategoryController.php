<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller
{
    public function index(Request $request) 
    {
        if (!$request->user()->isAdmin) {
            abort(403);
        }
        
        $data = Subcategory::with('category')->latest()->get();

        // dd($data->toArray());
        return view('admin.subcategory.index', [
            'categories' => $data
        ]);
    }

    public function create()
    {
        $data = Category::with('subcategory')->latest()->get();
        
        return view('admin.subcategory.createForm', [
            'subcategories' => $data
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Replace with your validation rules
            'category_id' => 'required|integer|exists:categories,id', // Ensure category exists
        ]);

       
        $categoryId = $validatedData['category_id'];
        $subcategoryName = $validatedData['name'];

        $category = Category::findorFail($categoryId);

        $subcategory = new SubCategory;
        $subcategory->name = $subcategoryName;
        $subcategory->category_id = $categoryId;
        $subcategory->save();

        

        session()->flash('success', 'Subcategories berhasil dibuat!');

        return redirect()->route('subcategory.index');

    }

    public function edit($id) {

        $subcategories = Subcategory::with('category')->find($id);
       

        return view('admin.subcategory.editForm',[
            'subcategories' => $subcategories
        ]);
    }

    public function update(Request $request, $id)
    {

        $subcategories = Subcategory::with('category')->find($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $subcategories->id, // Exclude current brand ID for uniqueness validation
        ]);

        $subcategories->update($request->all());

        Session()->flash('success', 'Subcategory berhasil diubah!');

        return redirect()->route('subcategory.index');


    }


    public function destroy($id)
    {
        $subcategories = Subcategory::with('category')->find($id);
        
        $subcategories->delete();

        Session()->flash('success', 'Subcategory berhasil dihapus!');

        return redirect()->route('subcategory.index');

    }
}
