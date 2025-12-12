@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Delegasyon Sonuçları</h3>
        <hr>

        <a href="{{ route('admin.delegates.calculate') }}" class="btn btn-primary mb-3">
            Yeni Delegasyon Hesapla
        </a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>Kulüp</th>
                <th>Seçim Yılı</th>
                <th>Delege Sayısı</th>
            </tr>
            </thead>
            <tbody>
            @forelse($delegates as $d)
                <tr>
                    <td>{{ $d->club->name }}</td>
                    <td>{{ $d->election_year }}</td>
                    <td>{{ $d->delegate_count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Henüz bir delegasyon kaydı bulunmuyor.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
@endsection
