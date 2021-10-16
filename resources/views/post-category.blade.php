@extends('app')
@section('content')
    <h1>{{$title}}</h1>


    <div class="row">
        <div class="col-9">
            <h3>{{$category->name}}</h3>
            <div class="row">
                @foreach ($posts as $post)
                    <div class="col-6 mt-4">

                        <div class="card">
                            <img src="/storage/{{$post->upload}}" class="card-img-top" alt="{{$post->title}}">
                            <div class="card-body">
                                <div class="card-title h5">
                                    <a href="/posts/{{$post->id}}">{{$post->title}}</a>
                                </div>
                                <p>
                                    {{$post->featured}}
                                </p>
                                {{--<p class="card-text">{{Str::words($post->message, 30)}}</p>--}}

                                <a href="/posts/{{$post->id}}" class="btn btn-primary">Read more about {{$post->title}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <p class="mt-3">{{ $posts->links() }}</p>
            </div>
        </div>
        <div class="col-3">
            <h3>Select Category</h3>
            <a href="/posts">All Posts</a>
            @foreach($categories as $category)
                <p class="mt-3">
                    <a href="/category/{{$category->id}}">{{$category->name}}</a>
                </p>
            @endforeach
        </div>

    </div>

@endsection

