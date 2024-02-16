@extends('layouts.backend')
@section('title','Dashboard')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Home</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
@endsection
