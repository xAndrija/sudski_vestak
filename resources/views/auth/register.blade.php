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
    .form-control, .form-select {
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
    <div class="login-title">Registracija</div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Unesite email:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Unesite korisničko ime:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autocomplete="name">
            @error('name')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Unesite lozinku:</label>
            <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password">
            @error('password')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Potvrdite lozinku:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password">
            @error('password_confirmation')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="uloga_id" class="form-label">Izaberite ulogu korisnika:</label>
            <select id="uloga_id" name="uloga_id" class="form-select" required>
                <option value="" disabled selected hidden>Izaberite...</option>
                @foreach($uloge as $uloga)
                    <option value="{{ $uloga->id }}">{{ $uloga->naziv }}</option>
                @endforeach
            </select>
            @error('uloga_id')
                <span class="text-danger small">{{ $message }}</span>
            @enderror
        </div>
        <div class="d-grid gap-2 text-center">
            <button class="btn btn-login" type="submit">Registracija</button>
        </div>
    </form>
    <div class="register-link">
        <span>Imate nalog?</span>
        <a href="{{ route('login') }}">Ulogujte se</a>
    </div>
</div>
@endsection
