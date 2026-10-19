@extends('layouts.app')

@section('title', 'Buat Pengumuman - Admin')
@section('page_title', 'Publikasi Pengumuman Baru')

@section('content')
<div class="glass-panel" style="max-width: 700px; margin: 0 auto;">
    <h3 class="mb-4">Tulis Pengumuman</h3>

    @if ($errors->any())
        <div class="alert alert-danger" style="background: #FEE2E2; color: #991B1B; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.pengumuman.store') }}" method="POST">
        @csrf
        <div class="form-group mb-4">
            <label class="form-label">Judul Pengumuman</label>
            <input type="text" name="judul" class="form-input" required value="{{ old('judul') }}" placeholder="Contoh: Libur Nasional Lebaran">
        </div>

        <div class="form-group mb-4">
            <label class="form-label">Target Penerima</label>
            <select name="target" class="form-input" required style="cursor: pointer;">
                <option value="semua" {{ old('target') == 'semua' ? 'selected' : '' }}>Semua Pengguna (Global)</option>
                <option value="siswa" {{ old('target') == 'siswa' ? 'selected' : '' }}>Hanya Siswa</option>
                <option value="guru" {{ old('target') == 'guru' ? 'selected' : '' }}>Hanya Guru</option>
                <option value="orang_tua" {{ old('target') == 'orang_tua' ? 'selected' : '' }}>Hanya Orang Tua</option>
            </select>
            <small class="text-muted" style="display: block; margin-top: 5px;">Pengumuman ini hanya akan muncul di Dasbor target yang dipilih.</small>
        </div>

        <div class="form-group mb-4">
            <label class="form-label">Isi Pengumuman</label>
            <textarea name="konten" class="form-input" required rows="6" placeholder="Tulis pesan Anda di sini...">{{ old('konten') }}</textarea>
        </div>

        <div style="display: flex; gap: 15px; margin-top: 30px;">
            <button type="submit" class="btn btn-primary" style="flex: 1; background: var(--secondary);"><i class="fas fa-paper-plane"></i> Publikasikan Sekarang</button>
            <a href="{{ route('dashboard.admin') }}" class="btn" style="flex: 1; text-align: center; background: #E2E8F0; color: #475569; text-decoration: none; border-radius: 12px; padding: 12px 24px; font-weight: 600;">Batal</a>
        </div>
    </form>
</div>
@endsection
