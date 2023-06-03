@extends('dashboard.layouts.main')

@section('title', 'Dashboard')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Welcome back, {{ auth()->user()->username }}</h1>
    </div>
    <div class="row mt-5">
        <div class="col-lg-4">
            <div class="card mb-3 bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">Books</h5>
                    <p class="card-text">100</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-3 bg-warning">
                <div class="card-body">
                    <h5 class="card-title">Category</h5>
                    <p class="card-text">7</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-3 bg-secondary text-white">
                <div class="card-body">
                    <h5 class="card-title">User</h5>
                    <p class="card-text">4</p>
                </div>
            </div>
        </div>
    </div>
@endsection