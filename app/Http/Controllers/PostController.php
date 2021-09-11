<?php

namespace App\Http\Controllers;

use App\Mail\PostMail;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    //show all posts
    public function all(){
        $categories = Category::all();
        return view('post-all',[
            'posts'=>Post::orderBy('created_at','desc')->paginate(12),
            'title'=>'All Posts',
            'categories'=>$categories,
        ]);
    }

    public function showByCategory(Category $category){
        return view('post-category',[
            'categories'=>Category::all(),//This is to get all columns from all categories
            'category'=>$category,// name on the left is up to you! this is the name you will be using later in the VIEW
            'posts'=>Post::where('category_id', $category['id'])->orderBy('created_at','desc')->paginate(10),
            'title'=>'Posts By Category'
        ]);
    }

    public function index(){ // create view or form
        return view('post-index',[
            'title'=>'Posts',
            'categories'=>Category::all(),//if you want to use a variable in your VIEW, first you must create it HERE
        ]);
    }

    public function create(Request $request){ // when you submit
        $category = Category::where('name', $request->post('category_name'))->first();

        if (!$category){
            return back()->withErrors('Select Category')->withInput();
        }

        // upload feature goes here

        $request->validate([
            'title'=>'Required|min:5|max:150',
            'featured'=>'Required|max:255',
            'message'=>'Required',
            'upload'=>'image|max:500'
        ]);

        $post = Post::create([
            'user_id'=>Auth::user()->id, // "user_id" here is from the posts table while "id" is from users table
            'category_id'=>$category['id'],
            'title'=>$request->post('title'),
            'featured'=>$request->post('featured'),
            'message'=>$request->post('message'),
        ]);

        if($request->file('upload')){
            // create random name with extension
            $new_file_name = rand(10, 99) . date('dmyhi') . '.' . $request->file('upload')->extension(); // 1150820211025.jpg
            // this physically uploads image
            Storage::putFileAs('public', $request->file('upload'), $new_file_name);

            // this saves random name you assigned earlier into the table posts' column "upload"
            $post->upload = $new_file_name;
            $post->save();
        }

        //send emails
        $users = User::all();
        Mail::to($users)->send(new PostMail($post));
        //Mail::to($request->post('myEmail'))->send(new NewWorkload($workload));

        return redirect('posts'); // redirect uses URL from the web (first param) ! Not the view
    }

    //Edit post
    public function edit(Post $post){
        //echo $post->category->name;

        return view('post-edit',[
            'title'=>'Edit Post',
            'post'=>$post,
            'categories'=>Category::all(),
        ]);
    }

    // Post $posost by ID (in the url),
    // Request $request to access the info / input fields that you receive from the form
    public function edit_process(Post $post, Request $request){

        $request->validate([
            'title'=>'Required|min:5|max:150',
            'featured'=>'Required|max:255',
            'message'=>'Required',
            'upload'=>'image|max:500'
        ]);
        //Get all the info from category table, save them in $category, then use the column you want
        $category = Category::where('name',$request->post('category_name'))->first(); // give me the category row/data where name is what user wrote in the form
        //print_r($category->id);

//continue tomorrow
        $filename = date('dhmi') // 289830
            . Auth::id() // 1
            . '.' // .
            . $request->file('upload')->extension(); // jpg
        // 2898301.jpg

        Storage::putFileAs('public',$request->file('upload'),$filename);
        // save in "public" the file "upload" with name "$filename"
        // by "public" we mean /storage/app/public
        // by "upload" we mean input file "upload" from the form - so what file user selected
        // by "$filename" we generate random name using date + user Auth id, e.g. 27843301.jpg


        Post::where('id',$post['id']) // you can use where('id', 1)
            ->update([
            'title'=>$request->post('title'),
            'featured'=>$request->post('featured'),
            'message'=>$request->post('message'),
            'category_id'=>$category->id,
            'upload'=>$filename,
        ]);
        return redirect('posts/'.$post['id']);
    }

    public function show(Post $post){
        //echo $post->user->name;
        return view('post-show',[
            'post'=>$post,
            'title'=>$post['title'],
        ]);
    }
}
