<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Proje Seçim') }}</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Admin Styles -->
    <style>
        body { background: #f8f9fa; }
        header.navbar { background:#1f2937; }
    </style>
</head>
<body>

<!-- Navigation -->
@include('layouts.navigation')

<!-- Page Heading -->
@isset($header)
    <div class="bg-white shadow-sm mb-4">
        <div class="container py-3">
            {{ $header }}
        </div>
    </div>
@endisset

<!-- Content -->
<main class="container py-4">
    {{ $slot }}
</main>

<!-- Bootstrap Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
