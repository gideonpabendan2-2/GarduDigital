@extends('layouts.app')

@section('title', 'Dashboard Guru - Analitik')
@section('page_title', 'Ringkasan Kelas ' . ($kelas ? $kelas->nama_kelas : 'Belum Ada Kelas'))
@section('body_class', 'body-guru')

@section('content')
<div class="grid-3 mb-6">
    <div class="glass-card">
        <div class="card-icon icon-blue">
            <i class="fas fa-users"></i>
        </div>
        <h2 style="margin:0; font-size: 2rem;">{{ $totalSiswa }}</h2>
        <p class="text-muted">Total Siswa Aktif</p>
    </div>
    <div class="glass-card">
        <div class="card-icon icon-green">
            <i class="fas fa-check-circle"></i>
        </div>
        <h2 style="margin:0; font-size: 2rem;">-</h2>
        <p class="text-muted">Rata-rata Kelulusan Kuis</p>
    </div>
    <div class="glass-card">
        <div class="card-icon icon-orange">
            <i class="fas fa-tasks"></i>
        </div>
        <h2 style="margin:0; font-size: 2rem;">-</h2>
        <p class="text-muted">Tugas Menunggu Penilaian</p>
    </div>
</div>

<div class="glass-panel" style="padding: 24px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin:0;">Progres Siswa {{ $kelas ? $kelas->nama_kelas : '' }}</h3>
        <button class="btn btn-primary" style="padding: 8px 16px; width: auto; font-size: 0.9rem;">Unduh Laporan</button>
    </div>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; text-align: left; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #E2E8F0;">
                    <th style="padding: 12px 10px;">Nama Siswa</th>
                    <th style="padding: 12px 10px;">Level & XP</th>
                    <th style="padding: 12px 10px;">Streak Belajar</th>
                    <th style="padding: 12px 10px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($daftarSiswa as $s)
                <tr style="border-bottom: 1px solid #E2E8F0;">
                    <td style="padding: 15px 10px; font-weight: 500;">
                        {{ $s->pengguna->nama }}<br>
                        <small class="text-muted">{{ $s->nisn }}</small>
                    </td>
                    <td style="padding: 15px 10px;">
                        <span class="stat-badge" style="padding: 4px 10px; font-size: 0.8rem; background: #FEF3C7; color: #D97706; border: none; display: inline-flex;">
                            <i class="fas fa-star" style="margin-right: 5px;"></i> Lv. {{ $s->level }}
                        </span>
                        <br><small class="text-muted">{{ $s->xp }} XP</small>
                    </td>
                    <td style="padding: 15px 10px;">{{ $s->streak }} Hari</td>
                    <td style="padding: 15px 10px;"><a href="#" style="color: var(--primary); text-decoration: none; font-weight: 500;">Detail</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 20px; text-align: center; color: #9CA3AF;">Belum ada data siswa di kelas ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
