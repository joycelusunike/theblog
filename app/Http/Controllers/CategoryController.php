<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index(){
        return view('category-index',[
            'categories'=>Category::all(),
            'title' => 'Categories',
        ]);
    }
    public function create(Request $request){
        $request->validate([
            'name'=>'Required|min:2|max:150',
        ]);
        Category::create([
            'name'=>$request->post('name'),
        ]);
        return redirect('category');
    }

}
