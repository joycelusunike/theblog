@extends('app')
@section('content')
    <h1>Welcome to your Dashboard {{\Illuminate\Support\Facades\Auth::user()->name}}!</h1>
@endsection
