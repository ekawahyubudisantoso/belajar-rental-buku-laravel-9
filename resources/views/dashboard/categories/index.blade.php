@extends('dashboard.layouts.main')

@section('title', 'Categories')

@section('container')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">List Categories</h1>
  </div>

  @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('success') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif

  <div class="table-responsive">
      <a href="/dashboard/categories/create" class="btn btn-primary mb-3">Create new category</a>
      <a href="/dashboard/categories/deleted" class="btn btn-secondary mb-3">View deleted category</a>
      <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Category Name</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                <td>
                    <a href="/dashboard/categories/edit/{{ $category->slug }}" class="badge bg-warning"><span data-feather="edit"></span></a>
                    <form action="/dashboard/categories/delete/{{ $category->slug }}" method="POST" class="d-inline">
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