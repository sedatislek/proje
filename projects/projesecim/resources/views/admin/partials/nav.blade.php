<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
    <div class="container-fluid">

        <!-- Logo / Başlık -->
        <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
            Yönetim Paneli
        </a>

        <!-- Mobil Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menü -->
        <div class="collapse navbar-collapse" id="adminNavbar">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                       href="{{ route('admin.dashboard') }}">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.clubs.*') ? 'active' : '' }}"
                       href="{{ route('admin.clubs.index') }}">
                        Kulüpler
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.competitions.*') ? 'active' : '' }}"
                       href="{{ route('admin.competitions.index') }}">
                        Yarışmalar
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.club-competitions.*') ? 'active' : '' }}"
                       href="{{ route('admin.club-competitions.index') }}">
                        Kulüp Katılımları
                    </a>
                </li>
            </ul>

            <!-- Sağ Bölüm (Kullanıcı & Çıkış) -->
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <span class="nav-link text-white">
                            {{ Auth::user()->name ?? 'Admin' }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-light btn-sm ms-2">Çıkış</button>
                        </form>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>
