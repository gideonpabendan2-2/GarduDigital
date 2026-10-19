@extends('layouts.app')

@section('title', 'Dashboard Orang Tua - Pantauan Anak')
@section('page_title', 'Pantauan Aktivitas Anak')
@section('body_class', 'body-ortu')

@section('content')

@if($anak)
<div class="glass-panel mb-6" style="display: flex; align-items: center; gap: 20px;">
    <div class="avatar" style="width: 80px; height: 80px; font-size: 2rem; background: linear-gradient(135deg, var(--secondary) 0%, #059669 100%);">
        {{ strtoupper(substr($anak->pengguna->nama, 0, 1)) }}
    </div>
    <div>
        <h2 style="margin: 0; margin-bottom: 5px;">{{ $anak->pengguna->nama }}</h2>
        <p class="text-muted" style="margin: 0;">
            <i class="fas fa-graduation-cap"></i> {{ $anak->kelas->nama_kelas ?? 'Belum ada kelas' }} | 
            <i class="fas fa-school"></i> {{ $anak->sekolah->nama_sekolah ?? 'Belum ada sekolah' }}
        </p>
    </div>
</div>

<div class="grid-3 mb-6">
    <div class="glass-card">
        <h3 class="text-muted" style="font-size: 1rem;">Level Saat Ini</h3>
        <h2 style="font-size: 2.5rem; margin: 10px 0; color: var(--accent);"><i class="fas fa-star"></i> {{ $anak->level }}</h2>
        <p class="text-muted" style="font-size: 0.9rem;">Total XP: {{ number_format($anak->xp) }}</p>
    </div>
    <div class="glass-card">
        <h3 class="text-muted" style="font-size: 1rem;">Hari Beruntun (Streak)</h3>
        <h2 style="font-size: 2.5rem; margin: 10px 0; color: var(--primary);">{{ $anak->streak }} Hari</h2>
        <p class="text-muted" style="font-size: 0.9rem; color: var(--secondary);">Pertahankan semangat belajar!</p>
    </div>
    <div class="glass-card">
        <h3 class="text-muted" style="font-size: 1rem;">Misi Diselesaikan</h3>
        <h2 style="font-size: 2.5rem; margin: 10px 0; color: var(--secondary);">{{ $anak->transaksiXp->count() }}</h2>
        <p class="text-muted" style="font-size: 0.9rem;">Total aktivitas tercatat</p>
    </div>
</div>

<h3 class="mb-4">Log Aktivitas Terbaru</h3>
<div class="glass-card">
    @forelse($anak->transaksiXp as $transaksi)
    <div style="display: flex; align-items: center; gap: 15px; border-bottom: 1px solid #E2E8F0; padding-bottom: 15px; margin-bottom: 15px;">
        <div style="width: 40px; height: 40px; border-radius: 50%; background: #E0E7FF; color: var(--primary); display: flex; align-items: center; justify-content: center;">
            @if($transaksi->sumber === 'kuis')
                <i class="fas fa-check"></i>
            @else
                <i class="fas fa-bolt"></i>
            @endif
        </div>
        <div>
            <h4 style="margin: 0;">{{ $transaksi->keterangan }}</h4>
            <p class="text-muted" style="margin: 0; font-size: 0.85rem;">{{ $transaksi->created_at->diffForHumans() }} <span style="color: var(--accent); font-weight: bold;">(+{{ $transaksi->jumlah_xp }} XP)</span></p>
        </div>
    </div>
    @empty
    <div style="text-align: center; color: #9CA3AF; padding: 20px;">
        Belum ada aktivitas terbaru.
    </div>
    @endforelse
</div>
@else
<div class="glass-panel text-center" style="padding: 50px;">
    <h2>Belum Ada Data Anak</h2>
    <p class="text-muted">Akun orang tua Anda belum dihubungkan dengan akun siswa manapun.</p>
</div>
@endif

@endsection
