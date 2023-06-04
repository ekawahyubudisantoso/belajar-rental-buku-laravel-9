@extends('dashboard.layouts.main')

@section('title', 'Books')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">List Books</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <div class="d-flex justify-content-end mb-3">
            <a href="/dashboard/books/deleted" class="btn btn-secondary">View deleted book</a>
            <a href="/dashboard/books/create" class="btn btn-primary mr-3">Create new book</a>
        </div>
        <table class="table table-striped table-sm">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Code</th>
            <th scope="col">Title</th>
            <th scope="col">Category</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $book->book_code }}</td>
                    <td>{{ $book->title }}</td>
                    <td>
                        @foreach ($book->categories as $category)
                            {{ $category->name }} 
                        @endforeach
                    </td>
                    <td>{{ $book->status }}</td>
                    <td>
                        <a href="/dashboard/books/edit/{{ $book->slug }}" class="badge bg-warning"><span data-feather="edit"></span></a>
                        <form action="/dashboard/books/delete/{{ $book->slug }}" method="POST" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Are you sure about that?')"><span data-feather="x-circle"></span></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>
@endsection