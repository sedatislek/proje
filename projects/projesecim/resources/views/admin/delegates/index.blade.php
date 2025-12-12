@extends('admin.layouts.app')

@section('content')
    <h3>Delegasyon Hesaplama (Seçim Yılı: {{ $electionYear }})</h3>

    <form method="GET" action="{{ route('admin.delegates.index') }}">
        <label>Seçim Yılı</label>
        <input type="number" name="election_year" value="{{ $electionYear }}" />
        <button type="submit">Hesapla</button>
    </form>

    <h4>Toplam delegeler (kulüp bazında)</h4>
    <table class="table">
        <thead><tr><th>Kulüp</th><th>Toplam Delegeler</th><th>Detay</th></tr></thead>
        <tbody>
        @foreach($byClub as $clubRow)
            <tr>
                <td>{{ $clubRow['club']->club_name }}</td>
                <td>{{ $clubRow['delegates'] }}</td>
                <td>
                    <ul>
                        @foreach($clubRow['details'] as $d)
                            <li>{{ $d['branch']->name }} - {{ $d['category']->name }} ({{ implode(', ', $d['season_years']) }})</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
