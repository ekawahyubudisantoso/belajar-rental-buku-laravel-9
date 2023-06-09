@extends('layouts.main')

@section('title', 'Home')

@section('container')
    <div class="row mb-3 justify-content-center">
        @foreach ($books as $book)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                <div class="card">
                    <img src="{{ asset('storage/'. $book->cover) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $book->title }}</h5>
                        <h6 class="card-subtitle mb-2 text-body-secondary">Tere Liye</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection