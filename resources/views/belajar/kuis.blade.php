@extends('layouts.quiz')

@section('title', 'Kuis ' . $kuis->judul)
@section('quiz_title', $kuis->judul)

@section('content')
<form action="{{ route('belajar.kuis.submit', $kuis->id) }}" method="POST">
    @csrf
    
    <div style="display: flex; flex-direction: column; gap: 40px; margin-top: 20px;">
        @foreach($kuis->pertanyaan as $index => $pertanyaan)
            <div class="quiz-card animate-float" style="animation-delay: {{ $index * 0.2 }}s;">
                <div style="background: rgba(255,255,255,0.2); display: inline-block; padding: 5px 15px; border-radius: 20px; font-weight: bold; margin-bottom: 20px;">
                    Pertanyaan {{ $index + 1 }} dari {{ $kuis->pertanyaan->count() }}
                </div>
                
                <h2 class="quiz-question">{{ $pertanyaan->pertanyaan }}</h2>
                
                <div class="quiz-options">
                    @foreach($pertanyaan->pilihanJawaban as $pilihan)
                        <label>
                            <input type="radio" name="jawaban[{{ $pertanyaan->id }}]" value="{{ $pilihan->id }}" class="quiz-radio" required>
                            <div class="quiz-btn">
                                {{ $pilihan->pilihan }}
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>

    <div style="text-align: center; margin-top: 50px; margin-bottom: 50px;">
        <button type="submit" class="btn btn-primary" style="font-size: 1.5rem; padding: 20px 50px; border-radius: 50px; box-shadow: 0 10px 30px rgba(79, 70, 229, 0.6); width: auto;">
            <i class="fas fa-paper-plane" style="margin-right: 15px;"></i> Selesai & Kirim Jawaban!
        </button>
    </div>
</form>
@endsection
