@extends('app')
@section('content')
    <h1>Edit your Profile {{\Illuminate\Support\Facades\Auth::user()->name}}!</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="" enctype="multipart/form-data">
        @csrf {{--laravel form protection feature--}}
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text"  name="name" value="{{\Illuminate\Support\Facades\Auth::user()->name}}" class="form-control" id="name" aria-describedby="nameHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" value="{{\Illuminate\Support\Facades\Auth::user()->email}}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="check" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Check me out</label>
        </div>
        <div class="mb-3">
            <label for="profile" class="form-label">Your Bio</label>
            <textarea  name="profile" class="form-control" id="profile" aria-describedby="profileHelp">{{\Illuminate\Support\Facades\Auth::user()->profile}}</textarea>
        </div>
        <div class="mb-3">
            <label for="upload" class="form-label">Your Photo</label>
            <input type="file"  name="upload" class="form-control" id="upload" aria-describedby="uploadHelp">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        ClassicEditor
            .create( document.querySelector( '#profile' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
