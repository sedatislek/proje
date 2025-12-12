@extends('admin.layouts.app')
@section('title','Yönetim Paneli')

@section('content')
    <div class="container py-4">

        <h1 class="mb-4">Federasyon Yönetim Paneli</h1>

        {{-- ÜST KARTLAR --}}
        <div class="row g-3">

            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-primary text-white p-3">
                    <h5>Kulüp Sayısı</h5>
                    <h2>{{ $clubCount }}</h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-success text-white p-3">
                    <h5>Yarışma Sayısı</h5>
                    <h2>{{ $competitionCount }}</h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-warning text-dark p-3">
                    <h5>Toplam Katılım</h5>
                    <h2>{{ $participationCount }}</h2>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm border-0 bg-danger text-white p-3">
                    <h5>Toplam Oy (Delege) Hakkı</h5>
                    <h2>{{ $totalVotes }}</h2>
                </div>
            </div>
        </div>


        {{-- İL BAZLI DELEGE GRAFİĞİ --}}
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-dark text-white">
                <strong>İl Bazlı Delege Sayısı</strong>
            </div>
            <div class="card-body">

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>İl</th>
                        <th>Delege Sayısı</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($delegatesByProvince as $province => $count)
                        <tr>
                            <td>{{ $province }}</td>
                            <td><strong>{{ $count }}</strong></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>


        {{-- KULÜP BAZLI DELEGE TABLOSU --}}
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-secondary text-white">
                <strong>Kulüplerin Delege Sayıları</strong>
            </div>
            <div class="card-body">

                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                    <tr>
                        <th>Kulüp</th>
                        <th>İl</th>
                        <th>Delege Sayısı</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($delegatesByClub as $club)
                        <tr>
                            <td>{{ $club['club_name'] }}</td>
                            <td>{{ $club['province'] }}</td>
                            <td><strong>{{ $club['count'] }}</strong></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>


        {{-- EN ÇOK DELEGEYE SAHİP İLK 10 KULÜP --}}
        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-info text-white">
                <strong>En Çok Delegesi Olan İlk 10 Kulüp</strong>
            </div>
            <div class="card-body">

                <ol class="list-group list-group-numbered">
                    @foreach($delegatesByClub->take(10) as $club)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $club['club_name'] }} ({{ $club['province'] }})
                            <span class="badge bg-primary rounded-pill">{{ $club['count'] }}</span>
                        </li>
                    @endforeach
                </ol>

            </div>
        </div>

    </div>
@endsection
