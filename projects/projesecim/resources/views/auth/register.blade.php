<x-guest-layout>
    <h3 class="text-center mb-4">Kayıt Ol</h3>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Ad Soyad</label>
            <input type="text" name="name" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label class="form-label">E-posta</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Şifre</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Şifre Tekrar</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <button class="btn btn-success w-100">Kayıt Ol</button>
    </form>

    <div class="text-center mt-3">
        <a href="{{ route('login') }}">Zaten hesabın var mı?</a>
    </div>
</x-guest-layout>
