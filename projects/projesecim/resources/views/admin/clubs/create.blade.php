@extends('admin.layouts.app')
@section('title','Yeni Kulüp')

@section('content')
    <div class="container mt-4">

        <h2>Yeni Kulüp Ekle</h2>

        <form method="POST" action="{{ route('admin.clubs.store') }}" class="mt-3">
            @csrf

            <div class="mb-3">
                <label class="form-label">Kulüp Adı</label>
                <input type="text" name="club_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">İl</label>
                <input type="text" name="province" class="form-control" placeholder="Örn: Konya" required>
            </div>

            <button class="btn btn-success">Kaydet</button>
        </form>

    </div>
@endsection
