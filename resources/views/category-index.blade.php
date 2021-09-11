@extends('app')
@section('content')
    <h1>{{$title}}</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="">
        @csrf {{--laravel form protection feature--}}
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text"  name="name" class="form-control" id="name" aria-describedby="nameHelp">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <h1>Posts Categories</h1>

    @foreach ($categories as $category)
        <p>{{$category->name}}</p>
    @endforeach

@endsection
