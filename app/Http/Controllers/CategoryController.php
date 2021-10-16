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
    public function update(Category $category){
        return view('category-update',[
            'title'=>'Update Category',
            'category'=>$category,
        ]);
    }

    public function process(Request $request, Category $category){
        $request->validate([
            'name'=>'Required|min:2|max:150',
        ]);
        $category->name = $request->post('name');
        $category->save();
        return redirect('category');
    }

    public function delete(Category $category){
        //echo $category->name;
        //print_r($category->posts);

        // $category->posts comes from Category Model; look at function posts()
        // 1) go through each post that belongs to this category and 2) change each post's category_id to 0
        foreach ($category->posts as $post){
            $post->category_id = 0;
            $post->save();
        }
        //Actual deleting of the category
        $category->delete();
        return redirect('category');
    }

}
