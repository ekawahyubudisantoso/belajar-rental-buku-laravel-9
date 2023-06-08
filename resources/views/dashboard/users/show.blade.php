@extends('dashboard.layouts.main')

@section('title', 'Users Detail')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">User Detail</h1>
    </div>

    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-end">
        @if ($user->status == 'inactive')
            <a href="/dashboard/users" class="btn btn-secondary me-1">Back</a>
            <a href="/dashboard/users/approve/{{ $user->slug }}" class="btn btn-primary">Approve User</a>
        @else
            <a href="/dashboard/users" class="btn btn-secondary">Back</a>
        @endif
    </div>
    <div class="row my-5">
        <div class="col-12 col-lg-8">
            <div class="card h-100">
                <div class="card-header">
                    <h4>Username</h4>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Special title treatment</h5>
                    <p class="card-text">{{ $user->username }}</p>
                    @if ($user->status == 'active')
                        <span class="badge text-bg-primary">{{ $user->status }}</span>
                    @else
                        <span class="badge text-bg-warning">{{ $user->status }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="border-bottom border-dashed border-300">
                        <h4 class="mb-3 lh-sm lh-xl-1">Default Address</h4>
                    </div>
                    <div class="pt-4 mb-7 mb-lg-4 mb-xl-7">
                        <div class="row justify-content-between">
                            <div class="col-auto">
                                <h5 class="text-1000">Address</h5>
                            </div>
                            <div class="col-auto">
                                <p class="text-800">{{ $user->address }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="border-top border-dashed border-300 pt-4">
                        <div class="row flex-between-center">
                            <div class="col-auto">
                                <h5 class="text-1000 mb-0">Phone</h5>
                            </div>
                            <div class="col-auto">
                                @if ($user->phone)
                                    <a class="text-800" href="tel:{{ $user->phone }}">{{ $user->phone }}</a>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection