<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
@include('admin.partials.nav')
<div class="container mt-4">
    @if(session('success'))
        <div style="background:#e6ffed;border:1px solid #b7f0c9;padding:8px;margin-bottom:12px;">{{ session('success') }}</div>
    @endif
    @yield('content')
</div>
</body>
</html>
