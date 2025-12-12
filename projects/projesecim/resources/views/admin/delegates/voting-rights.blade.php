@extends('admin.layouts.app')

@section('content')
    <div class="container mt-4">
        <h3>Delegasyon – Oy Hakkı Kuralları</h3>
        <hr>

        <p>
            Bu sayfa, kulüplerin seçim yılında oy hakkı kazanabilmesi için gerekli olan sezon katılım şartlarını özetlemektedir.
        </p>

        <h5>1. Sezon Mantığı</h5>
        <p>
            Seçim yılı olan <strong>Y</strong> için oy hakkı, önceki iki sezon olan <strong>Y-1</strong> ve <strong>Y-2</strong> yıllarındaki yarışmalara göre belirlenir.
            Seçim yılında yapılan yarışmalar oy hesabına dahil edilmez.
        </p>

        <h5>2. Oy Hakkı Şartları</h5>
        <ul>
            <li>Kulüp, Y-1 ve Y-2 sezonlarında yarışmış olmalıdır.</li>
            <li>Y-2 sezonunda (örneğin 2026) yarışmış fakat Y-1 sezonunda yarışmamışsa oy hakkı yoktur.</li>
            <li>Y-1 sezonunda yarışmış fakat Y-2 sezonunda yarışmamışsa oy hakkı yoktur.</li>
            <li>Her iki sezonda da yarışmış kulüp 1 oy hakkı kazanır.</li>
        </ul>

        <h5>3. Kategorik Farklar</h5>
        <p>
            Sistem, olimpik ve olimpik olmayan branş kategorilerini ayrı değerlendirir. Kulübün katıldığı branşın talimatnameye uygun kategori yapısı hesaplamaya doğrudan etki eder.
        </p>

        <a href="{{ route('admin.delegates.index') }}" class="btn btn-primary mt-3">
            Delegasyon Hesaplama Ekranına Git
        </a>
    </div>
@endsection
