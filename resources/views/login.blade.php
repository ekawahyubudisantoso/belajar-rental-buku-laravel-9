@extends('layouts.main')

@section('container')
    <div class="row justify-content-center">
        <div class="col-lg-5">

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('statusAccount'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('statusAccount') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <main class="form-signin w-100 m-auto">
                <h1 class="h3 mb-3 fw-normal">Form login</h1>
                <form action="/login" method="POST">
                    @csrf
                    <div class="form-floating">
                        <input type="text" name="username" class="form-control rounded-top @error('username') is-invalid @enderror" id="username" placeholder="Username" value="{{ old('username') }}" autofocus required>
                        <label for="username">Username</label>
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control rounded-bottom" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>

                    <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Login</button>
                </form>
                <small class="d-block text-center mt-3">Not registered? <a href="/register">Register now!</a></small>
            </main>
        </div>
    </div>
@endsection