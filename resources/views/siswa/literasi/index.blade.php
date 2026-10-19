@extends('layouts.app')

@section('title', 'Literasi Digital')
@section('page_title', 'Literasi Digital: Internet Aman')

@section('content')
<div class="glass-panel text-center mb-6" style="background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);">
    <i class="fas fa-shield-alt" style="font-size: 4rem; margin-bottom: 20px;"></i>
    <h1 style="font-size: 2.5rem; margin-bottom: 10px; color: white;">Pahlawan Internet</h1>
    <p style="font-size: 1.1rem; opacity: 0.9;">Pelajari cara melindungi diri dari bahaya di dunia maya.</p>
</div>

<div class="grid-2">
    @forelse($modulList as $modul)
        <div class="glass-card" style="border-left: 5px solid #10B981;">
            <div style="display: flex; align-items: flex-start; gap: 20px;">
                <div style="background: #D1FAE5; padding: 15px; border-radius: 12px; min-width: 60px; text-align: center;">
                    <i class="fas fa-book-reader" style="font-size: 2rem; color: #059669;"></i>
                </div>
                <div>
                    <h3 style="margin-top: 0; color: var(--text-main);">{{ $modul->judul }}</h3>
                    <p class="text-muted" style="margin-bottom: 15px;">{{ $modul->deskripsi }}</p>
                    <button class="btn btn-primary" style="background: #10B981;" onclick="alert('Isi modul:\n\n{{ $modul->konten }}')">Mulai Membaca</button>
                    <button class="btn" style="background: white; border: 2px solid #10B981; color: #10B981; margin-left: 10px;" onclick="alert('Kuis Literasi akan segera dimuat!')">Uji Pengetahuan</button>
                </div>
            </div>
        </div>
    @empty
        <div class="glass-card text-center" style="grid-column: span 2;">
            <p class="text-muted">Modul literasi digital belum tersedia saat ini.</p>
        </div>
    @endforelse
</div>
@endsection
