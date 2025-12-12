<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            Yönetim Paneli
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.clubs.index') }}">Kulüpler</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.competitions.index') }}">
                        Yarışmalar
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.club-competitions.index') }}">
                        Kulüp Katılımları
                    </a>
                </li>

            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item text-white me-3 d-flex align-items-center">
                        {{ Auth::user()->name }}
                    </li>

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-outline-light btn-sm">Çıkış Yap</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
