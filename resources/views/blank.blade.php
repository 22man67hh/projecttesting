@extends('layouts.frontend')
@section('title', 'Homepages')
@section('content')
<style>
    .product-name {
        color: #333;
        font-size: 1.2rem;
        margin-bottom: 5px;
    }

    .product-price {
        color: #d9534f;
        font-size: 1.1rem;
        font-weight: bold;
        margin-top: 5px;
    }
</style>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4 justify-content-center">
    @foreach($data['records'] as $index => $record)
        <div class="col mb-4">
            <div class="card h-100">
                @if ($record->photos->count() > 0)
                    <div>
                        <img src="{{ asset('storage/' . $record->photos->first()->photo_path) }}" alt="Photo" class="img-fluid">
                    </div>
                @else
                    <p>No photos available</p>
                @endif
                <div class="card-body p-3">
                    <div class="text-center">
                        <h5 class="fw-bolder product-name">Address:{{ $record->address }}</h5>
                        <h5 class=" product-name">Room:{{ $record->quantity }}</h5>
                        <p class="product-price">Rent:Rs {{ $record->rent }}</p>
                        <h5 class="fw-bolder product-name">Price:{{ $record->type}}</h5>
                    </div>
                </div>
                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                    <div class="text-center">
                        <a class="btn btn-outline-dark mt-auto" href="{{ route('roomDetail', ['id' => $record->id]) }}">View options</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    
</div>
@endsection

