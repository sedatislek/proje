@extends('admin.layouts.app')
@section('title','Kulüp Katılımları')

@section('content')
    <div class="container mt-4">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Kulüp Katılımları</h2>
            <a href="{{ route('admin.club-competitions.create') }}" class="btn btn-primary">+ Yeni Katılım</a>
        </div>

        {{-- Filtre Paneli --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-dark text-white">Filtrele</div>
            <div class="card-body">

                <form method="GET" class="row g-3">

                    {{-- Yıl --}}
                    <div class="col-md-2">
                        <label class="form-label">Sezon</label>
                        <select name="season_id" class="form-select">
                            <option value="">Hepsi</option>
                            @foreach($seasons as $s)
                                <option value="{{ $s->season_id }}" @selected(request('season_id') == $s->season_id)>
                                    {{ $s->season_year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Branş --}}
                    <div class="col-md-3">
                        <label class="form-label">Branş</label>
                        <select name="discipline_id" id="disciplineSelect" class="form-select">
                            <option value="">Hepsi</option>
                            @foreach($disciplines as $d)
                                <option value="{{ $d->discipline_id }}" @selected(request('discipline_id') == $d->discipline_id)>
                                    {{ $d->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kategori --}}
                    <div class="col-md-3">
                        <label class="form-label">Kategori</label>
                        <select name="category_id" id="categorySelect" class="form-select">
                            <option value="">Hepsi</option>
                            @foreach($categories as $c)
                                <option
                                    value="{{ $c->category_id }}"
                                    data-discipline="{{ $c->discipline_id }}"
                                    @selected(request('category_id') == $c->category_id)
                                >
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- İl --}}
                    <div class="col-md-2">
                        <label class="form-label">İl</label>
                        <select name="province" class="form-select">
                            <option value="">Hepsi</option>
                            @foreach($provinces as $p)
                                <option value="{{ $p->province }}" @selected(request('province') == $p->province)>
                                    {{ $p->province }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kulüp --}}
                    <div class="col-md-2">
                        <label class="form-label">Kulüp</label>
                        <select name="club_id" class="form-select">
                            <option value="">Hepsi</option>
                            @foreach($clubs as $c)
                                <option value="{{ $c->club_id }}" @selected(request('club_id') == $c->club_id)>
                                    {{ $c->club_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 text-end">
                        <button class="btn btn-success">Filtrele</button>
                        <a href="{{ route('admin.club-competitions.index') }}" class="btn btn-secondary">Sıfırla</a>
                    </div>

                </form>

            </div>
        </div>

        {{-- Liste --}}
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Kulüp</th>
                        <th>İl</th>
                        <th>Sezon</th>
                        <th>Branş</th>
                        <th>Kategori</th>
                        <th>Yarışma</th>
                        <th>Katıldı</th>
                        <th>Sonuç</th>
                        <th style="width:140px;">İşlem</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($items as $it)
                        <tr>
                            <td>{{ $it->id }}</td>
                            <td>{{ $it->club?->club_name }}</td>
                            <td>{{ $it->club?->province }}</td>
                            <td>{{ $it->season?->season_year }}</td>
                            <td>{{ $it->competition?->discipline?->name }}</td>
                            <td>{{ $it->competition?->category?->name }}</td>
                            <td>{{ $it->competition?->name }}</td>
                            <td>
                            <span class="badge {{ $it->participated ? 'bg-success':'bg-danger' }}">
                                {{ $it->participated ? 'Evet' : 'Hayır' }}
                            </span>
                            </td>
                            <td>{{ $it->result }}</td>

                            <td>
                                <a href="{{ route('admin.club-competitions.edit',$it->id) }}"
                                   class="btn btn-sm btn-warning">Düzenle</a>

                                <form action="{{ route('admin.club-competitions.destroy',$it->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Silinsin mi?')">Sil</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $items->links() }}
        </div>

    </div>

    {{-- BRANŞ → KATEGORİ FİLTRE JAVASCRIPT --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const disciplineSelect = document.getElementById('disciplineSelect');
            const categorySelect   = document.getElementById('categorySelect');

            function filterCategories() {
                const disciplineId = disciplineSelect.value;

                for (let option of categorySelect.options) {
                    const d = option.getAttribute('data-discipline');

                    if (!d || disciplineId === "" || d === disciplineId) {
                        option.style.display = "";
                    } else {
                        option.style.display = "none";
                    }
                }
            }

            disciplineSelect.addEventListener('change', filterCategories);
            filterCategories();

        });
    </script>

@endsection
