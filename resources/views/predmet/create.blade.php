@extends('layouts.bootstrap')

@section('content')
<style>
    body { background: #ccd2d9 !important; }
    .dodaj-predmet-middle {
        width: 100%;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        justify-content: flex-start;
        padding: 60px 0 0 0;
        box-sizing: border-box;
    }
    .dodaj-predmet-form-wrap {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 18px;
        min-width: 570px;
        margin-left: 120px;
    }
    .dodaj-predmet-title {
        text-align: center;
        font-size: 2.24rem;
        font-weight: bold;
        letter-spacing: 1px;
        margin-bottom: 35px;
        margin-top: 0;
        width: 100%;
    }
    .dodaj-predmet-form-label {
        font-size: 1.13rem;
        font-weight: 500;
        margin-bottom: 3px;
        color: #232934;
        width: 180px;
        display: inline-block;
    }
    .dodaj-predmet-row {
        margin-bottom: 13px;
        display: flex;
        align-items: center;
    }
    .dodaj-predmet-input, .dodaj-predmet-select {
        min-width: 230px;
        padding: 8px 14px;
        border-radius: 8px;
        border: 2px solid #8ca9bd;
        background: #a6bbc7;
        font-size: 1.09rem;
    }
    .dodaj-predmet-date::-webkit-input-placeholder { color: #777; }
    .dodaj-predmet-date::-moz-placeholder { color: #777; }
    .dodaj-predmet-date:-ms-input-placeholder { color: #777; }
    .dodaj-predmet-date::placeholder { color: #777; }
    .dodaj-predmet-dugmici {
        margin-top: 17px;
        gap: 22px;
        display: flex;
        flex-direction: row;
        align-items: center;
    }
    .dodaj-btn, .odustani-btn {
        display: inline-block;
        background: #b5bec4 !important;
        color: #222;
        font-weight: 500;
        font-size: .98rem;
        border-radius: 7px;
        border: 1px solid #6f7c85 !important;
        padding: 7px 21px;
        text-decoration: none;
        cursor: pointer;
        transition: background .18s, color .18s;
    }
    .dodaj-btn:hover, .odustani-btn:hover {
        background: #94a3ad !important;
        color: #101c2e;
        text-decoration: none;
    }
    @media (max-width: 991px) {
        .dodaj-predmet-middle { padding: 40px 20px 0 20px; }
        .dodaj-predmet-form-wrap { margin-left: 0; min-width: 0; width: calc(100vw - 40px); }
    }
</style>
<div class="dodaj-predmet-middle">
    <div class="dodaj-predmet-title">DODAJ PREDMET</div>
    <form method="POST" action="{{ route('predmet.store') }}" class="dodaj-predmet-form-wrap">
        @csrf
        @if ($errors->any())
            <div style="background:#f8d7da;color:#842029;border:1px solid #f5c2c7;border-radius:8px;padding:10px 12px;">
                <div style="font-weight:600;margin-bottom:6px;">Greška pri snimanju:</div>
                <ul style="margin:0;padding-left:18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="dodaj-predmet-row">
            <label class="dodaj-predmet-form-label" for="broj">Broj predmeta:</label>
            <input id="broj" name="broj" class="dodaj-predmet-input" type="text" value="{{ old('broj') }}" />
        </div>
        <div class="dodaj-predmet-row">
            <label class="dodaj-predmet-form-label" for="vrsta">Vrsta predmeta:</label>
            <select id="vrsta" name="vrsta" class="dodaj-predmet-select">
                <option value="" @selected(old('vrsta') === null || old('vrsta') === '')>Izaberite...</option>
                <option value="parnica" @selected(old('vrsta') === 'parnica')>Parnični predmet</option>
                <option value="krivicni" @selected(old('vrsta') === 'krivicni')>Krivični predmet</option>
            </select>
        </div>
        <div class="dodaj-predmet-row">
            <label class="dodaj-predmet-form-label" for="sud">Sud:</label>
            <input id="sud" name="sud" class="dodaj-predmet-input" type="text" value="{{ old('sud') }}" />
        </div>
        <div class="dodaj-predmet-row">
            <label class="dodaj-predmet-form-label" for="datum_prijema">Datum prijema:</label>
            <input id="datum_prijema" name="datum_prijema" class="dodaj-predmet-input dodaj-predmet-date" type="date" placeholder="Datum" value="{{ old('datum_prijema') }}" />
        </div>
        <div class="dodaj-predmet-row">
            <label class="dodaj-predmet-form-label" for="rok">Rok:</label>
            <input id="rok" name="rok" class="dodaj-predmet-input dodaj-predmet-date" type="date" placeholder="Datum" value="{{ old('rok') }}" />
        </div>
        <div class="dodaj-predmet-row">
            <label class="dodaj-predmet-form-label" for="status">Status:</label>
            <select id="status" name="status" class="dodaj-predmet-select">
                <option value="novo" @selected(old('status', 'novo') === 'novo')>Novo</option>
                <option value="u_obradi" @selected(old('status') === 'u_obradi')>U obradi</option>
                <option value="zavrsen" @selected(old('status') === 'zavrsen')>Završen</option>
                <option value="odbijen" @selected(old('status') === 'odbijen')>Odbijen</option>
            </select>
        </div>
        <div class="dodaj-predmet-dugmici">
            <button class="dodaj-btn" type="submit">Dodaj predmet</button>
            <a href="{{ route('predmeti') }}" class="odustani-btn">Odustani</a>
        </div>
    </form>
</div>
@endsection
