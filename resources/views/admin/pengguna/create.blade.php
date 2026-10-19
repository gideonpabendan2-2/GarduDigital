@extends('layouts.app')

@section('title', 'Tambah Pengguna - Admin')
@section('page_title', 'Tambah Pengguna Baru')

@section('content')
<div class="glass-panel" style="max-width: 600px; margin: 0 auto;">
    <h3 class="mb-4">Formulir Pendaftaran</h3>

    @if ($errors->any())
        <div class="alert alert-danger" style="background: #FEE2E2; color: #991B1B; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pengguna.store') }}" method="POST">
        @csrf
        <div class="form-group mb-4">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama" class="form-input" required value="{{ old('nama') }}" placeholder="Contoh: Budi Santoso">
        </div>

        <div class="form-group mb-4">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input" required value="{{ old('email') }}" placeholder="Contoh: budi@siswa.id">
        </div>

        <div class="form-group mb-4">
            <label class="form-label">Kata Sandi (Minimal 6 karakter)</label>
            <input type="password" name="password" class="form-input" required placeholder="Masukkan kata sandi...">
        </div>

        <div class="form-group mb-4">
            <label class="form-label">Peran (Role)</label>
            <select name="peran" class="form-input" required style="cursor: pointer;">
                <option value="">-- Pilih Peran --</option>
                <option value="siswa" {{ old('peran') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                <option value="guru" {{ old('peran') == 'guru' ? 'selected' : '' }}>Guru</option>
                <option value="orang_tua" {{ old('peran') == 'orang_tua' ? 'selected' : '' }}>Orang Tua</option>
                <option value="admin" {{ old('peran') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <div style="display: flex; gap: 15px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary" style="flex: 1;"><i class="fas fa-save"></i> Simpan Pengguna</button>
            <a href="{{ route('dashboard.admin') }}" class="btn" style="flex: 1; text-align: center; background: #E2E8F0; color: #475569; text-decoration: none; border-radius: 12px; padding: 12px 24px; font-weight: 600;">Batal</a>
        </div>
    </form>
</div>
@endsection
