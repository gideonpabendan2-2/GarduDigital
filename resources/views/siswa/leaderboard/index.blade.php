@extends('layouts.app')

@section('title', 'Papan Peringkat')
@section('page_title', 'Papan Peringkat Tertinggi')

@section('content')
<div class="glass-panel text-center mb-6" style="background: linear-gradient(135deg, #7C3AED 0%, #4F46E5 100%); color: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 25px rgba(124, 58, 237, 0.3);">
    <i class="fas fa-trophy" style="font-size: 4rem; margin-bottom: 20px; color: #FBBF24;"></i>
    <h1 style="font-size: 2.5rem; margin-bottom: 10px; color: white;">Papan Peringkat Kelas</h1>
    <p style="font-size: 1.1rem; opacity: 0.9;">Kumpulkan XP sebanyak-banyaknya dan jadilah nomor satu!</p>
</div>

<div class="glass-panel" style="padding: 30px;">
    @if($topSiswa->count() > 0)
        <!-- Podium -->
        <div style="display: flex; justify-content: center; align-items: flex-end; gap: 20px; margin-bottom: 50px; margin-top: 20px;">
            <!-- Juara 2 -->
            @if(isset($topSiswa[1]))
            <div style="text-align: center; width: 120px;">
                <div style="position: relative;">
                    <div style="width: 60px; height: 60px; border-radius: 50%; background: #E2E8F0; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: bold; border: 4px solid #CBD5E1;">
                        {{ substr($topSiswa[1]->pengguna->nama, 0, 1) }}
                    </div>
                    <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); color: #94A3B8; font-size: 1.5rem;"><i class="fas fa-medal"></i></div>
                </div>
                <div style="font-weight: 600; font-size: 0.9rem;">{{ explode(' ', $topSiswa[1]->pengguna->nama)[0] }}</div>
                <div style="color: var(--primary); font-weight: bold; font-size: 0.8rem;">{{ $topSiswa[1]->xp }} XP</div>
                <div style="height: 80px; background: linear-gradient(to top, #E2E8F0, #F1F5F9); border-radius: 10px 10px 0 0; margin-top: 10px; border: 1px solid #CBD5E1; border-bottom: none;">
                    <h2 style="margin: 0; padding-top: 10px; color: #64748B;">2</h2>
                </div>
            </div>
            @endif

            <!-- Juara 1 -->
            <div style="text-align: center; width: 140px;">
                <div style="position: relative;">
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: #FEF3C7; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: bold; border: 4px solid #FCD34D;">
                        {{ substr($topSiswa[0]->pengguna->nama, 0, 1) }}
                    </div>
                    <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); color: #F59E0B; font-size: 2rem;"><i class="fas fa-crown"></i></div>
                </div>
                <div style="font-weight: 600; font-size: 1.1rem;">{{ explode(' ', $topSiswa[0]->pengguna->nama)[0] }}</div>
                <div style="color: var(--primary); font-weight: bold; font-size: 0.9rem;">{{ $topSiswa[0]->xp }} XP</div>
                <div style="height: 120px; background: linear-gradient(to top, #FEF3C7, #FFFBEB); border-radius: 10px 10px 0 0; margin-top: 10px; border: 1px solid #FCD34D; border-bottom: none;">
                    <h1 style="margin: 0; padding-top: 10px; color: #D97706; font-size: 2.5rem;">1</h1>
                </div>
            </div>

            <!-- Juara 3 -->
            @if(isset($topSiswa[2]))
            <div style="text-align: center; width: 120px;">
                <div style="position: relative;">
                    <div style="width: 60px; height: 60px; border-radius: 50%; background: #FFEDD5; margin: 0 auto 10px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: bold; border: 4px solid #FDBA74;">
                        {{ substr($topSiswa[2]->pengguna->nama, 0, 1) }}
                    </div>
                    <div style="position: absolute; top: -15px; left: 50%; transform: translateX(-50%); color: #EA580C; font-size: 1.5rem;"><i class="fas fa-medal"></i></div>
                </div>
                <div style="font-weight: 600; font-size: 0.9rem;">{{ explode(' ', $topSiswa[2]->pengguna->nama)[0] }}</div>
                <div style="color: var(--primary); font-weight: bold; font-size: 0.8rem;">{{ $topSiswa[2]->xp }} XP</div>
                <div style="height: 60px; background: linear-gradient(to top, #FFEDD5, #FFF7ED); border-radius: 10px 10px 0 0; margin-top: 10px; border: 1px solid #FDBA74; border-bottom: none;">
                    <h3 style="margin: 0; padding-top: 10px; color: #C2410C;">3</h3>
                </div>
            </div>
            @endif
        </div>

        <!-- Sisanya -->
        @if($topSiswa->count() > 3)
            <div style="background: rgba(255,255,255,0.5); border-radius: 15px; padding: 20px;">
                @foreach($topSiswa->skip(3) as $index => $siswa)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 15px; border-bottom: 1px solid rgba(0,0,0,0.05); {{ $loop->last ? 'border-bottom: none;' : '' }}">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <span style="font-size: 1.2rem; font-weight: bold; color: var(--text-muted); width: 30px;">#{{ $index + 4 }}</span>
                        <div class="avatar" style="width: 40px; height: 40px; font-size: 1rem;">{{ substr($siswa->pengguna->nama, 0, 1) }}</div>
                        <div>
                            <div style="font-weight: 600;">{{ $siswa->pengguna->nama }}</div>
                            <div style="font-size: 0.85rem; color: var(--text-muted);">Level {{ $siswa->level }}</div>
                        </div>
                    </div>
                    <div style="font-weight: bold; color: var(--primary);">{{ $siswa->xp }} XP</div>
                </div>
                @endforeach
            </div>
        @endif
    @else
        <div class="text-center" style="padding: 40px;">
            <p class="text-muted">Papan peringkat masih kosong. Mulailah kumpulkan XP sekarang!</p>
        </div>
    @endif
</div>
@endsection
