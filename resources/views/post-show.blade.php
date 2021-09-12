@extends('app')
@section('content')
    <img src="/storage/{{$post->upload}}" class="card-img-top" alt="{{$post->title}}">

    <div class="card" >
        <div class="card-body">
            <div class="card-title h5">
                <a href="/posts/{{$post->id}}">{{$post->title}}</a>
            </div>
            <p class="card-text">{!! htmlspecialchars_decode($post->message) !!}</p>
        </div>
    </div>


    <!--<p>{{$post->user->name}}</p>-->


    @auth()
        @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)
            <p><a href="/edit/{{$post->id}}"  class="btn btn-primary mt-3">Edit Post</a></p>
        @endif
        <form method="post" action="">
        @csrf {{--laravel form protection feature--}}
        <div class="mb-3">
            <label for="comment" class="form-label">Your Comment</label>
            <textarea  name="comment" class="form-control" id="comment" aria-describedby="commentHelp"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    @endauth

     @foreach($post->comments as $comment)
        <p>{{$comment->comment}}<br>{{$comment->user->name}}</p>
     @endforeach
@endsection
