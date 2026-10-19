@extends('layouts.app')

@section('title', 'Login - Gardu Belajar Digital')

@section('content')
<div class="auth-layout">
    <!-- Animated Blobs for Glassmorphism Background -->
    <div class="auth-blob blob-1 animate-float"></div>
    <div class="auth-blob blob-2 animate-float" style="animation-delay: 2s;"></div>

    <div class="auth-box">
        <div class="glass-panel">
            <div class="text-center mb-6">
                <div class="avatar" style="width: 72px; height: 72px; margin: 0 auto 20px; font-size: 1.8rem; background: linear-gradient(135deg, var(--primary), #9333EA);">GB</div>
                <h1 class="text-gradient" style="font-size: 2.2rem;">Selamat Datang</h1>
                <p class="text-muted">Masuk ke Gardu Belajar Digital</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul style="padding-left: 20px; margin: 0;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="username" class="form-label">Email Pengguna</label>
                    <input type="email" id="username" name="username" class="form-input" value="{{ old('username') }}" required autofocus placeholder="Masukkan email Anda (contoh: gideon@siswa.id)...">
                </div>

                <div class="form-group mb-6">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" id="password" name="password" class="form-input" required placeholder="Masukkan kata sandi...">
                </div>

                <button type="submit" class="btn btn-primary">
                    Mulai Belajar <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
                </button>
            </form>
            
            <div class="text-center mt-4 text-muted" style="font-size: 0.9rem;">
                <p>Belum punya akun? Hubungi Admin Sekolah.</p>
            </div>
        </div>
    </div>
</div>
@endsection
