@extends('layouts.app')

@section('content')
<div style="max-width: 420px; margin: 3rem auto;">
    <div class="card">
        <h2 style="margin-bottom: 0.5rem; font-size: 1.5rem;">Welcome Back</h2>
        <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">Sign in to your XMM account</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span style="color: var(--danger); font-size: 0.8rem;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">Login</button>
        </form>

        <p style="text-align: center; margin-top: 1.5rem; font-size: 0.875rem; color: var(--text-muted);">
            Don't have an account? <a href="{{ route('register') }}" style="color: var(--accent); text-decoration: none;">Sign Up</a>
        </p>
    </div>
</div>
@endsection