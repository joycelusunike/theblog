@extends('app')
@section('content')
    <h1>Sign Up for Newsletter</h1>
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
            <label for="name" class="form-label">Full Name</label>
            <input required type="text"  name="name" class="form-control" id="name" aria-describedby="nameHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword2" class="form-label">Verify Password</label>
            <input type="password" name="password2" class="form-control" id="exampleInputPassword2">
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" name="newsletter" class="form-check-input" id="exampleCheck1" checked>
            <label class="form-check-label" for="exampleCheck1">I agree to receive emails from time to time</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
