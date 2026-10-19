@extends('layouts.app')

@section('title', 'Dashboard Siswa - Petualangan Belajar')
@section('page_title', 'Petualangan Belajar')
@section('body_class', 'body-siswa')

@section('content')
<div class="hero-siswa">
    <!-- Animated background elements -->
    <div style="position: absolute; right: -50px; top: -50px; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%;" class="animate-pulse"></div>
    <div style="position: absolute; right: 100px; bottom: -30px; width: 100px; height: 100px; background: rgba(255,255,255,0.2); border-radius: 50%;" class="animate-float"></div>

    <div class="hero-siswa-content">
        <h1>Hai, {{ $siswa->pengguna->nama }}! 🚀</h1>
        <p style="font-size: 1.2rem; opacity: 0.9;">Siap untuk petualangan belajarmu hari ini?</p>

        <div class="stats-badges">
            <div class="stat-badge">
                <i class="fas fa-star" style="color: #FCD34D;"></i> Level {{ $siswa->level }}
            </div>
            <div class="stat-badge">
                <i class="fas fa-bolt" style="color: #F87171;"></i> {{ $siswa->xp }} XP
            </div>
            <div class="stat-badge">
                <i class="fas fa-fire" style="color: #FB923C;"></i> {{ $siswa->streak }} Hari Beruntun!
            </div>
        </div>
        
        <div style="margin-top: 20px; max-width: 400px;">
            <div style="display: flex; justify-content: space-between; font-size: 0.9rem; font-weight: 600;">
                <span>Progres ke Level {{ $siswa->level + 1 }}</span>
                <span>{{ $siswa->xp % 1000 }} / 1000 XP</span>
            </div>
            <div class="progress-bg">
                <div class="progress-fill" style="width: {{ ($siswa->xp % 1000) / 10 }}%;"></div>
            </div>
        </div>
    </div>
    
    <!-- Mascot Illustration placeholder -->
    <div style="width: 250px; height: 250px; background: rgba(255,255,255,0.1); border-radius: var(--radius-lg); backdrop-filter: blur(5px); border: 2px solid rgba(255,255,255,0.2); display: flex; align-items: center; justify-content: center; font-size: 5rem; z-index: 2;" class="animate-float">
        🧑‍🚀
    </div>
</div>

<div class="grid-3 mb-6">
    <div class="glass-card">
        <div class="card-icon icon-blue">
            <i class="fas fa-map"></i>
        </div>
        <h3>Misi Hari Ini</h3>
        <p class="text-muted">Selesaikan kuis pecahan untuk mendapatkan +150 XP dan lencana baru!</p>
        <a href="{{ route('siswa.misi') }}" class="btn btn-primary mt-4" style="padding: 10px 20px; font-size: 0.9rem;">Mulai Misi</a>
    </div>

    <div class="glass-card">
        <div class="card-icon icon-orange">
            <i class="fas fa-medal"></i>
        </div>
        <h3>Lencana Terbaru</h3>
        <div style="display: flex; gap: 15px; margin-top: 15px;">
            <div style="width: 50px; height: 50px; background: #FEF3C7; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;" title="Master Pecahan">🍕</div>
            <div style="width: 50px; height: 50px; background: #E0E7FF; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;" title="Pejuang Literasi">💻</div>
            <div style="width: 50px; height: 50px; background: #F3F4F6; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: #9CA3AF;"><i class="fas fa-lock"></i></div>
        </div>
    </div>

    <div class="glass-card">
        <div class="card-icon icon-green">
            <i class="fas fa-users"></i>
        </div>
        <h3>Kelompok Belajar</h3>
        <p class="text-muted">Kelompok "Rajawali" sedang memimpin papan peringkat kelas!</p>
        <a href="{{ route('siswa.leaderboard') }}" class="btn btn-primary mt-4" style="padding: 10px 20px; font-size: 0.9rem; background: var(--secondary);">Lihat Peringkat</a>
    </div>
</div>

<h3 class="mb-4">Mata Pelajaran</h3>
<div class="grid-4">
    @forelse($mataPelajaran as $mapel)
        @php
            // Hitung progres (placeholder, untuk produksi kita akan hitung berdasarkan materi_id yang diselesaikan)
            // Untuk demo: kita asumsikan acak progres berdasarkan id
            $progress = rand(10, 90); 
            $colors = ['var(--primary)', 'var(--secondary)', '#F59E0B', '#10B981'];
            $color = $colors[$mapel->id % count($colors)];
        @endphp
        <!-- Link to Mapel -->
        <a href="{{ route('belajar.peta', $mapel->id) }}" style="text-decoration: none; color: inherit;">
            <div class="glass-card" style="text-align: center; transition: transform 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="font-size: 3rem; margin-bottom: 15px;">{{ $mapel->ikon ?? '📚' }}</div>
                <h4>{{ $mapel->nama }}</h4>
                <div class="progress-bg"><div class="progress-fill" style="width: {{ $progress }}%; background: {{ $color }};"></div></div>
                <p class="text-muted" style="font-size: 0.85rem; margin-top: 10px;">{{ $progress }}% Selesai</p>
            </div>
        </a>
    @empty
        <div class="glass-card" style="grid-column: span 4; text-align: center;">
            <p class="text-muted">Belum ada mata pelajaran yang tersedia.</p>
        </div>
    @endforelse
</div>
@endsection
