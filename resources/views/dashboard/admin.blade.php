@extends('layouts.app')

@section('title', 'Dashboard Admin - Sistem Sekolah')
@section('page_title', 'Sistem Administrasi Sekolah')

@section('content')
<div class="grid-4 mb-6">
    <div class="glass-card text-center">
        <h3 class="text-muted">Total Pengguna</h3>
        <h2 style="font-size: 2.5rem; color: var(--primary);">{{ number_format($stats['total_pengguna']) }}</h2>
    </div>
    <div class="glass-card text-center">
        <h3 class="text-muted">Siswa Aktif</h3>
        <h2 style="font-size: 2.5rem; color: var(--secondary);">{{ number_format($stats['siswa_aktif']) }}</h2>
    </div>
    <div class="glass-card text-center">
        <h3 class="text-muted">Total Guru</h3>
        <h2 style="font-size: 2.5rem; color: var(--accent);">{{ number_format($stats['total_guru']) }}</h2>
    </div>
    <div class="glass-card text-center">
        <h3 class="text-muted">Materi Pelajaran</h3>
        <h2 style="font-size: 2.5rem; color: var(--text-main);">{{ number_format($stats['total_materi']) }}</h2>
    </div>
</div>

<div class="glass-panel" style="padding: 24px;">
    <h3>Tindakan Cepat</h3>

    @if (session('success'))
        <div class="alert alert-success" style="background: #D1FAE5; color: #065F46; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <div style="display: flex; gap: 15px; margin-top: 20px;">
        <a href="{{ route('admin.pengguna.create') }}" class="btn btn-primary" style="width: auto; text-decoration: none;"><i class="fas fa-plus"></i> Tambah Pengguna</a>
        <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary" style="width: auto; background: var(--secondary); text-decoration: none;"><i class="fas fa-bullhorn"></i> Buat Pengumuman</a>
        <a href="{{ route('admin.backup.download') }}" class="btn btn-primary" style="width: auto; background: var(--text-muted); text-decoration: none;"><i class="fas fa-file-export"></i> Backup Database</a>
    </div>
</div>
@endsection
