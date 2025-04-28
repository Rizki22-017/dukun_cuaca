@extends('layout')

@section('container')
@if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                html: `
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
            `,
                showConfirmButton: true
            });
        </script>
    @endif
    @if (session('warning'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: '{{ session('warning') }}',
                showConfirmButton: true
            });
        </script>
    @endif
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

    <div class="container mt-4">
        <h2>Login</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <p class="mt-3">Belum punya akun? <a href="{{ route('register.form') }}">Register disini</a></p>
    </div>
@endsection
