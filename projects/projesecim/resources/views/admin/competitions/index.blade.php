@extends('admin.layouts.app')
@section('title','Yarışmalar')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Yarışmalar</h2>
            <a href="{{ route('admin.competitions.create') }}" class="btn btn-primary">
                Yeni Yarışma
            </a>
        </div>

        @foreach($grouped as $discipline => $genderGroups)

            <div class="card mb-4 shadow">
                <div class="card-header bg-dark text-white">
                    <strong>{{ mb_strtoupper($discipline,'UTF-8') }}</strong> Branşı Yarışmaları
                </div>

                <div class="card-body">

                    @foreach($genderGroups as $gender => $items)

                        <h5 class="mt-3 mb-2 text-primary">
                            {{ $gender }} Kategorileri
                        </h5>

                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Yarışma Adı</th>
                                <th>Sezon</th>
                                <th>Kategori</th>
                                <th>Tür</th>
                                <th>Takım?</th>
                                <th style="width:150px;">İşlem</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($items as $c)
                                <tr>
                                    <td>{{ $c->competition_id }}</td>
                                    <td>{{ $c->name }}</td>

                                    <td>{{ $c->season?->season_year }}</td>
                                    <td>{{ $c->category?->name }}</td>

                                    <td>{{ strtoupper(str_replace('_',' ', $c->competition_type)) }}</td>
                                    <td>{{ $c->is_team_event ? 'Evet' : 'Hayır' }}</td>

                                    <td>
                                        <a href="{{ route('admin.competitions.edit',$c->competition_id) }}"
                                           class="btn btn-sm btn-warning">
                                            Düzenle
                                        </a>

                                        <form method="POST"
                                              action="{{ route('admin.competitions.destroy',$c->competition_id) }}"
                                              class="d-inline">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Silinsin mi?')">
                                                Sil
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                    @endforeach

                </div>
            </div>

        @endforeach

    </div>
@endsection
