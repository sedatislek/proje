@extends('admin.layouts.app')
@section('title','Yeni Yarışma')

@section('content')
    <div class="container mt-4">

        <h2 class="mb-4">Yeni Yarışma Ekle</h2>

        <div class="card shadow">
            <div class="card-body">

                <form method="POST" action="{{ route('admin.competitions.store') }}">
                    @csrf

                    {{-- Yarışma Adı --}}
                    <div class="mb-3">
                        <label class="form-label">Yarışma Adı</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    {{-- Sezon --}}
                    <div class="mb-3">
                        <label class="form-label">Sezon</label>
                        <select name="season_id" class="form-select">
                            <option value="">Seçiniz</option>
                            @foreach($seasons as $s)
                                <option value="{{ $s->season_id }}">{{ $s->season_year }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Branş --}}
                    <div class="mb-3">
                        <label class="form-label">Branş</label>
                        <select name="discipline_id" id="disciplineSelect" class="form-select" required>
                            <option value="">Seçiniz</option>
                            @foreach($disciplines as $d)
                                <option value="{{ $d->discipline_id }}">{{ $d->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kategori — branşa göre otomatik filtrelenecek JS ile --}}
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="category_id" id="categorySelect" class="form-select" required>
                            <option value="">Önce branş seçin</option>
                            @foreach($categories as $c)
                                <option value="{{ $c->category_id }}"
                                        data-discipline="{{ $c->discipline_id }}">
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Yarışma Tipi --}}
                    <div class="mb-3">
                        <label class="form-label">Yarışma Türü</label>
                        <select name="competition_type" class="form-select" required>
                            @foreach($types as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Takım etkinliği --}}
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="is_team_event" value="1">
                        <label class="form-check-label">Takım Yarışması</label>
                    </div>

                    <button class="btn btn-primary">Kaydet</button>

                </form>

            </div>
        </div>

    </div>

    {{-- BRANŞ → KATEGORİ FİLTRE JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const disciplineSelect = document.getElementById('disciplineSelect');
            const categorySelect = document.getElementById('categorySelect');

            function filterCategories() {
                const selectedDiscipline = disciplineSelect.value;

                for (let option of categorySelect.options) {
                    const d = option.getAttribute('data-discipline');

                    if (!d || d === selectedDiscipline) {
                        option.style.display = '';
                    } else {
                        option.style.display = 'none';
                    }
                }

                categorySelect.value = '';
            }

            disciplineSelect.addEventListener('change', filterCategories);

        });
    </script>
@endsection
