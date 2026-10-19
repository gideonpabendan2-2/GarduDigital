@extends('layouts.app')

@section('title', 'Petualangan Misi')
@section('page_title', 'Petualangan Misi Harian')

@section('content')
<div class="glass-panel text-center mb-6" style="background: linear-gradient(135deg, #F59E0B 0%, #D97706 100%); color: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 25px rgba(245, 158, 11, 0.3);">
    <i class="fas fa-scroll" style="font-size: 4rem; margin-bottom: 20px;"></i>
    <h1 style="font-size: 2.5rem; margin-bottom: 10px; color: white;">Papan Misi Harian</h1>
    <p style="font-size: 1.1rem; opacity: 0.9;">Selesaikan misi-misi di bawah ini untuk mendapatkan XP tambahan dan naik level lebih cepat!</p>
</div>

<div class="grid-3">
    @forelse($misiList as $misi)
        <div class="glass-card" style="position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; width: 80px; height: 80px; background: rgba(245, 158, 11, 0.1); border-radius: 50%; z-index: 0;"></div>
            <div style="position: relative; z-index: 1;">
                <h3 style="margin-top: 0; color: var(--text-main);">{{ $misi->judul }}</h3>
                <p class="text-muted" style="font-size: 0.9rem; margin-bottom: 15px;">{{ $misi->deskripsi }}</p>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px;">
                    <span class="stat-badge" style="background: #FEF3C7; color: #D97706; border: none; font-weight: bold; font-size: 0.9rem; padding: 6px 12px;">
                        +{{ $misi->reward_xp }} XP
                    </span>
                    <button class="btn btn-primary" style="padding: 6px 15px; font-size: 0.9rem;" onclick="alert('Fitur Pengerjaan Misi akan segera hadir!')">Ambil Misi</button>
                </div>
            </div>
        </div>
    @empty
        <div class="glass-card" style="grid-column: span 3; text-align: center; padding: 40px;">
            <i class="fas fa-check-circle" style="font-size: 3rem; color: #10B981; margin-bottom: 15px;"></i>
            <h3>Semua Misi Selesai!</h3>
            <p class="text-muted">Hebat sekali! Kamu sudah menyelesaikan semua misi yang tersedia saat ini. Kembalilah besok untuk misi baru.</p>
        </div>
    @endforelse
</div>
@endsection
