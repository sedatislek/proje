<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proje Seçim Sistemi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">
    <h1 class="text-center mb-4">Proje Seçim Sistemi</h1>

    <div class="text-center">
        @auth
            <a href="/admin" class="btn btn-primary btn-lg">Yönetim Paneline Git</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-success btn-lg">Giriş Yap</a>
        @endauth
    </div>
</div>

</body>
</html>
