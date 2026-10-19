@extends('layouts.app')

@section('title', 'Zona Bermain')
@section('page_title', 'Zona Bermain Edukatif')

@section('content')
<div class="glass-panel text-center mb-6" style="background: linear-gradient(135deg, #EC4899 0%, #BE185D 100%); color: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 25px rgba(236, 72, 153, 0.3);">
    <i class="fas fa-gamepad" style="font-size: 4rem; margin-bottom: 20px;"></i>
    <h1 style="font-size: 2.5rem; margin-bottom: 10px; color: white;">Arcade Pintar</h1>
    <p style="font-size: 1.1rem; opacity: 0.9;">Mainkan mini-games seru sambil melatih ketangkasan otakmu!</p>
</div>

<div class="grid-4">
    <!-- Dummy Games for MVP -->
    <div class="glass-card text-center" style="cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onclick="alert('Game Tebak Kata akan segera dimuat!')">
        <div style="background: #FCE7F3; padding: 20px; border-radius: 15px; margin-bottom: 15px;">
            <i class="fas fa-font" style="font-size: 3rem; color: #DB2777;"></i>
        </div>
        <h3 style="margin-bottom: 5px;">Tebak Kata</h3>
        <p class="text-muted" style="font-size: 0.85rem;">Susun huruf menjadi kata yang benar!</p>
    </div>

    <div class="glass-card text-center" style="cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onclick="alert('Game Hitung Cepat akan segera dimuat!')">
        <div style="background: #E0E7FF; padding: 20px; border-radius: 15px; margin-bottom: 15px;">
            <i class="fas fa-calculator" style="font-size: 3rem; color: #4F46E5;"></i>
        </div>
        <h3 style="margin-bottom: 5px;">Hitung Cepat</h3>
        <p class="text-muted" style="font-size: 0.85rem;">Lawan waktu dalam menjawab soal MTK!</p>
    </div>

    <div class="glass-card text-center" style="cursor: pointer; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" onclick="alert('Game Mencocokkan Pasangan akan segera dimuat!')">
        <div style="background: #D1FAE5; padding: 20px; border-radius: 15px; margin-bottom: 15px;">
            <i class="fas fa-puzzle-piece" style="font-size: 3rem; color: #059669;"></i>
        </div>
        <h3 style="margin-bottom: 5px;">Pasang Puzzle</h3>
        <p class="text-muted" style="font-size: 0.85rem;">Cari pasangan gambar yang tepat.</p>
    </div>

    <div class="glass-card text-center" style="opacity: 0.6;">
        <div style="background: #F3F4F6; padding: 20px; border-radius: 15px; margin-bottom: 15px;">
            <i class="fas fa-lock" style="font-size: 3rem; color: #9CA3AF;"></i>
        </div>
        <h3 style="margin-bottom: 5px;">Segera Hadir</h3>
        <p class="text-muted" style="font-size: 0.85rem;">Game baru sedang dibuat.</p>
    </div>
</div>
@endsection
