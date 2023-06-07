@extends('dashboard.layouts.main')

@section('title', 'Edit Book')

@section('container')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Book</h1>
    </div>
    <div class="col-lg-4 mb-5">
        <form action="/dashboard/books/edit/{{ $book->slug }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="book_code" class="form-label">Book Code</label>
                <input type="text" class="form-control @error('book_code') is-invalid @enderror" id="book_code" name="book_code" value="{{ old('book_code', $book->book_code) }}" required autofocus>
                @error('book_code')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $book->title) }}" required autofocus>
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="slug" class="form-label">Slug</label>
                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $book->slug) }}" required>
                @error('slug')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Cover</label>
                <input type="hidden" name="oldImage" value="{{ $book->cover }}">
                @if ($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="" class="d-block img-preview img-fluid mb-3 col-sm-5">
                @else
                    <img src="{{ asset('images/cover-not-available.jpg') }}" alt="" class="d-block img-preview img-fluid mb-3 col-sm-5">
                    {{-- <img class="img-preview img-fluid mb-3 col-sm-5"> --}}
                @endif
                <input class="form-control @error('cover') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
                @error('cover')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category_id[]" class="form-select select-multiple" multiple>
                    @foreach ($categories as $category)
                        @if (old('category_id') == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Current category</label>
                <ul>
                    @foreach ($book->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
            </div>
            
            <a href="/dashboard/books" class="btn btn-danger">Back</a>
            <button type="submit" class="btn btn-primary">Update book</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function(){
            fetch('/dashboard/books/checkSlug?title=' + title.value)
                .then(response => response.json())
                    .then(data => slug.value = data.slug)
        });

        function previewImage(){
            const image = document.querySelector('#image');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result;
            }
        }

        $(document).ready(function() {
            $('.select-multiple').select2();
        });
    </script>
@endsection