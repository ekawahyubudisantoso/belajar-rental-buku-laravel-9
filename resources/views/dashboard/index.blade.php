@extends('dashboard.layouts.main')

@section('title', 'Dashboard')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome back, {{ auth()->user()->username }}</h1>
    </div>
    @if (auth()->user()->role_id == 1)
        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="card mb-3 bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Books</h5>
                        <p class="card-text">{{ $book_count }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-3 bg-info">
                    <div class="card-body">
                        <h5 class="card-title">Category</h5>
                        <p class="card-text">{{ $category_count }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card mb-3 bg-secondary text-white">
                    <div class="card-body">
                        <h5 class="card-title">User</h5>
                        <p class="card-text">{{ $user_count }}</p>
                    </div>
                </div>
            </div>
        </div>
        <h3 class="mb-8">#Rent Logs</h3>
        <div class="table-responsive">
            <x-rent-log-table :rentlog='$rentlogs' />
        </div>
    @else
        
    @endif
@endsection