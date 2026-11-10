@extends('layouts.app')
@section('title', 'Login')
@section('content')
<main class="container gv-login">
    <div class="card gv-login-card">
        <div class="d-flex align-items-center justify-content-center gap-3 mb-4">
            <h1 class="gv-page-title mb-0">Game Store</h1>
        </div>
        <p class="gv-muted mb-4">Masukkan username untuk melihat katalog.</p>
        <form action="{{ route('dashboard') }}" method="GET">
            <div class="mb-4">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Masukkan username" maxlength="30" autocomplete="username" required autofocus>
            </div>
            <button type="submit" class="btn btn-primary btn-lg w-100">Masuk</button>
        </form>
    </div>
</main>
@endsection
