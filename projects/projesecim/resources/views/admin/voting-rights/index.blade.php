@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Oy Hakkı Hesaplama</h1>

        <table class="table mt-4">
            <thead>
            <tr>
                <th>Kulüp</th>
                <th>Katıldığı Yarışma Sayısı</th>
                <th>Oy Hakkı</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clubs as $club)
                <tr>
                    <td>{{ $club->club_name }}</td>
                    <td>{{ $club->participations_count }}</td>
                    <td>
                        {{-- Şimdilik basit örnek formül --}}
                        {{ $club->participations_count >= 3 ? 1 : 0 }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
