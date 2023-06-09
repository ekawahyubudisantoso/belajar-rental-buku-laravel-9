@extends('layouts.main')

@section('title', 'Books')

@section('container')
    <form action="/books">
        <div class="row mb-3">
            <div class="col-12 col-sm-6">
                <select name="category" id="category" class="form-control">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        @if (request('category') == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search title..." name="title" value="{{ request('title') }}">
                    <button class="btn btn-secondary" type="submit">Search</button>
                </div>
            </div>
        </div>
    </form>
    <div class="row mb-3">
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