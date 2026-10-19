@extends('layouts.app')

@section('title', 'Peta ' . $mapel->nama)
@section('page_title', 'Dunia ' . $mapel->nama)
@section('body_class', 'body-siswa')

@section('content')
<div class="mb-4">
    <a href="{{ route('dashboard.siswa') }}" class="btn" style="background: rgba(255,255,255,0.7); color: var(--text-main); width: auto;"><i class="fas fa-arrow-left"></i> Kembali ke Markas</a>
</div>

<div class="glass-panel" style="padding: 40px; text-align: center; margin-bottom: 30px;">
    <h1>Petualangan <span class="text-gradient">{{ $mapel->nama }}</span></h1>
    <p class="text-muted" style="font-size: 1.1rem;">Selesaikan level secara berurutan untuk mendapatkan XP dan lencana!</p>
</div>

<div class="level-map-container">
    <div style="position: relative; width: 100%; height: 400px; display: flex; justify-content: space-around; align-items: center; flex-wrap: wrap;">
        
        @foreach($mapel->materi as $index => $materi)
            @php
                $isCompleted = $siswa->progresBelajar->where('materi_id', $materi->id)->where('status', 'selesai')->isNotEmpty();
                
                // For demo, assume level is unlocked if previous is completed or it's the first one
                $isUnlocked = true;
                if ($index > 0) {
                    $prevMateri = $mapel->materi[$index - 1];
                    $isUnlocked = $siswa->progresBelajar->where('materi_id', $prevMateri->id)->where('status', 'selesai')->isNotEmpty();
                }

                $isActive = $isUnlocked && !$isCompleted;
                $kuisId = $materi->kuis->first()->id ?? null;
            @endphp

            <div style="display: flex; flex-direction: column; align-items: center; z-index: 5; margin: 20px;">
                @if($isCompleted)
                    <div class="level-node" style="background: var(--secondary); color: white; border-color: white;" title="{{ $materi->judul }}">
                        <i class="fas fa-star"></i>
                    </div>
                @elseif($isActive)
                    @if($kuisId)
                        <a href="{{ route('belajar.kuis', $kuisId) }}" style="text-decoration: none;">
                            <div class="level-node node-active" title="{{ $materi->judul }}">
                                {{ $index + 1 }}
                            </div>
                        </a>
                    @else
                        <div class="level-node node-active" title="{{ $materi->judul }}">
                            {{ $index + 1 }}
                        </div>
                    @endif
                @else
                    <div class="level-node node-locked" title="Terkunci: Selesaikan level sebelumnya!">
                        <i class="fas fa-lock"></i>
                    </div>
                @endif
                
                <div style="margin-top: 15px; font-weight: 700; background: rgba(255,255,255,0.7); padding: 5px 15px; border-radius: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                    {{ \Illuminate\Support\Str::limit($materi->judul, 20) }}
                </div>
            </div>
        @endforeach

    </div>
</div>
@endsection
