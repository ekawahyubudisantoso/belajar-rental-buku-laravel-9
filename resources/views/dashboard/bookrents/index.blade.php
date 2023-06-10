@extends('dashboard.layouts.main')

@section('title', 'Book Rents')

@section('container')

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form Book Rents</h1>
    </div>

    @if (session('message'))
        <div class="alert {{ session('alert-class') }} alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="/dashboard/book-rents" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label for="user_id" class="form-label">User</label>
                <select id="user_id" name="user_id" class="form-select select-multiple">
                    <option value="">Select User</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="book_id" class="form-label">Book</label>
                <select id="book_id" name="book_id" class="form-select select-multiple">
                    <option value="">Select Books</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <button type="submit" class="btn btn-primary w-100">Submit</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <div class="d-flex justify-content-end mb-3">
            <a href="/dashboard/books/deleted" class="btn btn-secondary me-1">View deleted book</a>
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
                {{-- @foreach ($books as $book)
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
                @endforeach --}}
            </tbody>
        </table>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select-multiple').select2();
        });
    </script>
@endsection