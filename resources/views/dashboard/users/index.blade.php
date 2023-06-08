@extends('dashboard.layouts.main')

@section('title', 'Users')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">List Users</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <div class="d-flex justify-content-end mb-3">
            <a href="/dashboard/users/banned" class="btn btn-secondary me-1">Banned Users</a>
            <a href="/dashboard/users/registered" class="btn btn-primary mr-3">New Registered User</a>
        </div>
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
                            <a href="/dashboard/users/detail/{{ $user->slug }}" class="badge bg-info"><span data-feather="eye"></span></a>
                            <a href="/dashboard/users/edit/{{ $user->slug }}" class="badge bg-warning"><span data-feather="edit"></span></a>
                            <form action="/dashboard/users/banned/{{ $user->slug }}" method="POST" class="d-inline">
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