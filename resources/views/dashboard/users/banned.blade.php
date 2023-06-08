@extends('dashboard.layouts.main')

@section('title', 'Banned Users')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">List Banned Users</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <a href="/dashboard/users" class="btn btn-primary mb-3"><span data-feather="arrow-left"></span> Back</a>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Username</th>
                <th scope="col">Phone</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            @if ($user->phone)
                                {{ $user->phone }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $user->status }}</td>
                        <td>
                            <a href="/dashboard/users/restore/{{ $user->slug }}" class="badge bg-info"><span data-feather="rotate-ccw"></span></a>
                            <form action="/dashboard/users/force-delete/{{ $user->slug }}" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="badge bg-danger border-0" onclick="return confirm('Are you sure about that?')"><span data-feather="trash"></span></button>
                              </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
      </div>
@endsection