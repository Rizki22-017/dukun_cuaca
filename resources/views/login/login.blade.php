@extends('layout')

@section('container')
    <div class="container mt-4">
        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="form-section">

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary mb-2">Login</button>
                <br>
                <span>Belum punya akun? Silahkan <a href="{{ url('register') }}">register disini</a></span>
            </div>
        </form>
    </div>
@endsection
