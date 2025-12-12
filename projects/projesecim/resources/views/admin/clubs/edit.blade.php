@extends('admin.layouts.app')
@section('title','Kulüp Düzenle')

@section('content')
    <div class="container mt-4">

        <h2>Kulüp Düzenle</h2>

        <form method="POST" action="{{ route('admin.clubs.update', $club->club_id) }}" class="mt-3">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kulüp Adı</label>
                <input type="text" name="club_name" class="form-control" value="{{ $club->club_name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">İl</label>
                <input type="text" name="province" class="form-control" value="{{ $club->province }}" required>
            </div>

            <button class="btn btn-success">Kaydet</button>
        </form>

    </div>
@endsection
