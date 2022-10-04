<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() {

        $categories = Category::all();
        return view('admin.category.index', compact('categories'));
    }

    public function add(){
        return view('admin.category.add-category');
    }

    public function create(Request $request) {

        $request->validate(['name' => 'required']);
        Category::create($request->input());
        return redirect('admin/categories')->with('message', 'Category has been successfully created');
       
    }

    public function delete($id){
        Category::destroy($id);
        return redirect('admin/categories')->with('message','Category has been successfully deleted');
    }

    public function edit($id){
        $category = Category::find($id);
        return view('admin.category.edit-category',compact('category'));

    }

    public function update(Request $request, $id){

        $request->validate(['name' => 'required', 'status' => 'required']);
        $category = Category::find($id);
        $category->update($request->input());
        return redirect('admin/categories')->with('message', 'Category has been updated');
    }
}
