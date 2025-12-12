@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Delegasyon Hesaplama</h3>
        <hr>

        <form method="POST" action="{{ route('admin.delegates.calculate.run') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Seçim Yılı</label>
                <input type="number"
                       class="form-control @error('election_year') is-invalid @enderror"
                       name="election_year"
                       value="{{ old('election_year', date('Y') + 1) }}"
                       placeholder="Örn: 2028">

                @error('election_year')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button class="btn btn-success">Hesaplamayı Başlat</button>
        </form>

    </div>
@endsection
