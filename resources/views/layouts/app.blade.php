<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Gardu Belajar Digital')</title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="@yield('body_class')">

    @auth
        <div class="dashboard-layout">
            <!-- Sidebar -->
            <aside class="sidebar glass-panel" style="border-radius: 0; border-left: none; border-top: none; border-bottom: none; z-index: 100;">
                <div class="sidebar-logo">
                    <div class="avatar" style="width: 40px; height: 40px; font-size: 1rem; background: linear-gradient(135deg, var(--primary), #9333EA);">GB</div>
                    <h2 class="text-gradient" style="font-size: 1.3rem;">Gardu Belajar</h2>
                </div>

                <nav>
                    @if(Auth::user()->peran == 'siswa')
                        <a href="{{ route('dashboard.siswa') }}" class="nav-link {{ request()->routeIs('dashboard.siswa') ? 'active' : '' }}"><i class="fas fa-home"></i> Beranda Belajar</a>
                        <a href="{{ route('siswa.misi') }}" class="nav-link {{ request()->routeIs('siswa.misi') ? 'active' : '' }}"><i class="fas fa-map-signs"></i> Petualangan Misi</a>
                        <a href="{{ route('siswa.bermain') }}" class="nav-link {{ request()->routeIs('siswa.bermain') ? 'active' : '' }}"><i class="fas fa-gamepad"></i> Zona Bermain</a>
                        <a href="{{ route('siswa.literasi') }}" class="nav-link {{ request()->routeIs('siswa.literasi') ? 'active' : '' }}"><i class="fas fa-shield-alt"></i> Literasi Digital</a>
                    @elseif(Auth::user()->peran == 'guru')
                        <a href="{{ route('dashboard.guru') }}" class="nav-link active"><i class="fas fa-chart-line"></i> Ringkasan Kelas</a>
                        <a href="#" class="nav-link"><i class="fas fa-book"></i> Kelola Materi</a>
                        <a href="#" class="nav-link"><i class="fas fa-tasks"></i> Penilaian Kuis</a>
                    @elseif(Auth::user()->peran == 'orang_tua')
                        <a href="{{ route('dashboard.orang_tua') }}" class="nav-link active"><i class="fas fa-chart-pie"></i> Progres Anak</a>
                    @elseif(Auth::user()->peran == 'admin')
                        <a href="{{ route('dashboard.admin') }}" class="nav-link active"><i class="fas fa-cogs"></i> Sistem Sekolah</a>
                    @endif
                </nav>

                <div class="sidebar-bottom">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link" style="width: 100%; border: none; background: transparent; cursor: pointer; text-align: left; color: var(--danger); font-family: inherit; font-size: 1rem;">
                            <i class="fas fa-sign-out-alt"></i> Keluar Aplikasi
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="main-content">
                <header class="topbar">
                    <div>
                        <h2 style="margin: 0; color: var(--text-muted); font-weight: 500;">@yield('page_title')</h2>
                    </div>
                    <div class="user-profile">
                        <div style="text-align: right;">
                            <div style="font-weight: 600;">{{ Auth::user()->nama }}</div>
                            <div style="font-size: 0.85rem; color: var(--text-muted); text-transform: capitalize;">Peran: {{ str_replace('_', ' ', Auth::user()->peran) }}</div>
                        </div>
                        <div class="avatar">{{ substr(Auth::user()->nama, 0, 1) }}</div>
                    </div>
                </header>

                @yield('content')
            </main>
        </div>
    @else
        <!-- Guest Layout (Login) -->
        @yield('content')
    @endauth

</body>
</html>
