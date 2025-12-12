<x-guest-layout>
    <h3 class="text-center mb-4">Giriş Yap</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            Geçersiz giriş bilgisi.
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">E-posta</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label class="form-label">Şifre</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember">
                <label class="form-check-label">Beni hatırla</label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">Şifremi unuttum?</a>
            @endif
        </div>

        <button class="btn btn-primary w-100">Giriş Yap</button>
    </form>

    @if (Route::has('register'))
        <div class="text-center mt-3">
            <a href="{{ route('register') }}">Hesap oluştur</a>
        </div>
    @endif
</x-guest-layout>
