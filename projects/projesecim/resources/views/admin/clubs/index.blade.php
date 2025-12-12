@extends('admin.layouts.app')
@section('title','Kulüpler')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Kulüpler</h2>
            <a href="{{ route('admin.clubs.create') }}" class="btn btn-primary">Yeni Kulüp</a>
        </div>

        @foreach($grouped as $province => $clubs)

            @continue($clubs->isEmpty()) {{-- boş il kartlarını gösterme --}}

            @php
                $provinceLabel = $province ? mb_strtoupper($province, 'UTF-8') : 'BİLİNMİYOR';
            @endphp

            <div class="card mb-4">
                <div class="card-header bg-dark text-white">
                    <strong>{{ $provinceLabel }}</strong> İli Kulüpleri
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Kulüp Adı</th>
                            <th>Durum</th>
                            <th style="width:160px;">İşlem</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($clubs as $c)
                            <tr>
                                <td>{{ $c->club_id }}</td>
                                <td>{{ $c->club_name }}</td>
                                <td>
                                    <span class="badge {{ $c->is_active ? 'bg-success':'bg-secondary' }}">
                                        {{ $c->is_active ? 'Aktif':'Pasif' }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.clubs.edit', $c->club_id) }}"
                                       class="btn btn-sm btn-warning">
                                        Düzenle
                                    </a>

                                    <form action="{{ route('admin.clubs.destroy',$c->club_id) }}"
                                          method="POST"
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
                </div>
            </div>
        @endforeach

    </div>
@endsection
