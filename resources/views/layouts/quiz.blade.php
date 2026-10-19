<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kuis Interaktif')</title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="quiz-fullscreen">

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <a href="javascript:history.back()" class="btn" style="background: rgba(255,255,255,0.2); color: white; width: auto; border: 1px solid rgba(255,255,255,0.3);"><i class="fas fa-arrow-left" style="margin-right: 8px;"></i> Batal Kuis</a>
        <div style="background: rgba(255,255,255,0.2); padding: 10px 20px; border-radius: 50px; font-weight: bold; border: 1px solid rgba(255,255,255,0.3);">
            <i class="fas fa-star" style="color: #FCD34D;"></i> @yield('quiz_title')
        </div>
    </div>

    @yield('content')

</body>
</html>
