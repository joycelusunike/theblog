@extends('app')
@section('content')
    <h1>{{\Illuminate\Support\Facades\Auth::user()->name}}'s Profile!</h1>

    <div class="container pt-3">
        <div class="row">
            <div class="col-3">
                <figure class="figure">
                    <img src="/storage/profiles/{{\Illuminate\Support\Facades\Auth::user()->photo}}" class="figure-img img-fluid rounded" alt="{{\Illuminate\Support\Facades\Auth::user()->name}}">
                    <figcaption class="figure-caption">{{\Illuminate\Support\Facades\Auth::user()->name}}</figcaption>
                </figure>
            </div>
            <div class="col-9">
                <p>{{\Illuminate\Support\Facades\Auth::user()->name}}</p>
                <p>{{\Illuminate\Support\Facades\Auth::user()->email}}</p>
                <p>{!!\Illuminate\Support\Facades\Auth::user()->profile!!}</p>
            </div>
        </div>
    </div>

@endsection
