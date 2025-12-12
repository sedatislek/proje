@extends('admin.layouts.app')
@section('title','Katılım Düzenle')

@section('content')
    <div class="container mt-4">

        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <strong>Katılım Düzenle</strong>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.club-competitions.update', $item->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Kulüp</label>
                        <select name="club_id" class="form-select" required>
                            @foreach($clubs as $club)
                                <option value="{{ $club->club_id }}" @selected($club->club_id == $item->club_id)>
                                    {{ $club->club_name }} ({{ $club->province }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sezon</label>
                        <select name="season_id" class="form-select" required>
                            @foreach($seasons as $s)
                                <option value="{{ $s->season_id }}" @selected($s->season_id == $item->season_id)>
                                    {{ $s->season_year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Yarışma</label>
                        <select name="competition_id" class="form-select" required>
                            @foreach($competitions as $c)
                                <option value="{{ $c->competition_id }}" @selected($c->competition_id == $item->competition_id)>
                                    {{ $c->name }} ({{ $c->discipline?->name }} - {{ $c->category?->name }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" name="participated" value="1"
                            @checked($item->participated)>
                        <label class="form-check-label">Katıldı</label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Sonuç</label>
                        <input type="text" name="result" class="form-control" value="{{ $item->result }}">
                    </div>

                    <button class="btn btn-primary">Güncelle</button>
                </form>
            </div>
        </div>
    </div>
@endsection
