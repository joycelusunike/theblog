@extends('app')
@section('content')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function onSubmit(token) {
            document.getElementById("login").submit();
        }
    </script>
    <h1>Login here</h1>

    <form id="login" method="post" action="">
        @csrf {{--laravel form protection feature--}}
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary g-recaptcha" data-sitekey="6LfRCjEcAAAAAJSqwztG8E6C-xHSMcwgD2CYtRh4" data-callback='onSubmit'>Submit</button>
        <a href="/login/facebook" class="btn btn-primary">Login via Facebook</a>
    </form>
@endsection
