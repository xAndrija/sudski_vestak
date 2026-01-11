@extends('layouts.bootstrap')

@section('content')
<style>
    .login-card {
        background: #426cd1;
        border-radius: 32px;
        box-shadow: 2px 4px 8px rgba(16,32,64,.2);
        margin: 50px auto;
        padding: 48px 32px;
        max-width: 430px;
    }
    .login-title {
        color: #fff;
        font-weight: bold;
        margin-bottom: 32px;
        font-size: 2rem;
        text-align: center;
    }
    .form-label {
        color: #fff;
        font-weight: 400;
        margin-bottom: 8px;
    }
    .form-control {
        background: #ddd !important;
        border: none !important;
        border-radius: 16px !important;
        margin-bottom: 24px;
        height: 38px;
    }
    .btn-login {
        background: #959595;
        color: #222;
        border-radius: 12px;
        min-width: 120px;
        margin-top: 10px;
        margin-bottom: 12px;
    }
    .register-link {
        color: #222;
        font-size: 1rem;
        text-align: center;
        margin-top: 18px;
        display: block;
    }
    .register-link span {
        color: #fff;
    }
    .register-link a {
        color: #222;
        text-decoration: underline;
        margin-left: .25em;
        font-size: .98em;
    }
</style>
<div class="login-card">
    <div class="login-title">Prijava</div>

    @if (session('status'))
        <div class="alert alert-success mb-3">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Unesite korisničko ime:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus autocomplete="username">
            @error('name')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="form-label">Unesite lozinku:</label>
            <input type="password" id="password" name="password" class="form-control" required autocomplete="current-password">
            @error('password')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>
        <div class="d-grid gap-2 text-center">
            <button class="btn btn-login" type="submit">Prijava</button>
        </div>
    </form>
    <div class="register-link">
        <span>Nemate nalog?</span>
        <a href="{{ route('register') }}">Registrujte se</a>
    </div>
</div>
@endsection
