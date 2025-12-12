@extends('admin.layouts.app')
@section('title','Yarışma Düzenle')

@section('content')
    <div class="container mt-4">

        <h2 class="mb-4">Yarışma Düzenle</h2>

        <div class="card shadow">
            <div class="card-body">

                <form action="{{ route('admin.competitions.update', $competition->competition_id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Yarışma Adı --}}
                    <div class="mb-3">
                        <label class="form-label">Yarışma Adı</label>
                        <input type="text" name="name" class="form-control"
                               value="{{ $competition->name }}" required>
                    </div>

                    {{-- Sezon --}}
                    <div class="mb-3">
                        <label class="form-label">Sezon</label>
                        <select name="season_id" class="form-select">
                            <option value="">Seçiniz</option>
                            @foreach($seasons as $s)
                                <option value="{{ $s->season_id }}"
                                    {{ $competition->season_id == $s->season_id ? 'selected' : '' }}>
                                    {{ $s->season_year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Branş --}}
                    <div class="mb-3">
                        <label class="form-label">Branş</label>
                        <select name="discipline_id" id="disciplineSelect" class="form-select" required>
                            <option value="">Seçiniz</option>
                            @foreach($disciplines as $d)
                                <option value="{{ $d->discipline_id }}"
                                        @if($competition->discipline_id == $d->discipline_id) selected @endif>
                                    {{ $d->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="category_id" id="categorySelect" class="form-select" required>
                            @foreach($categories as $c)
                                <option value="{{ $c->category_id }}"
                                        data-discipline="{{ $c->discipline_id }}"
                                        @if($competition->category_id == $c->category_id) selected @endif>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Yarışma Türü --}}
                    <div class="mb-3">
                        <label class="form-label">Yarışma Türü</label>
                        <select name="competition_type" class="form-select" required>
                            @foreach($types as $key => $label)
                                <option value="{{ $key }}"
                                    {{ $competition->competition_type == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Takım etkinliği --}}
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" name="is_team_event" value="1"
                            {{ $competition->is_team_event ? 'checked' : '' }}>
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
            }

            disciplineSelect.addEventListener('change', filterCategories);

            // Sayfa açılırken seçilen branşa göre kategori filtreleme
            filterCategories();

        });
    </script>

@endsection
