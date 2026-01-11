@extends('layouts.bootstrap')

@section('content')
<style>
    body { background: #ccd2d9 !important; }
    .dodaj-zahtev-middle {
        width: 100%;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        justify-content: flex-start;
        padding: 60px 0 0 0;
        box-sizing: border-box;
    }
    .dodaj-zahtev-form-wrap {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 18px;
        min-width: 570px;
        margin-left: 120px;
    }
    .dodaj-zahtev-title {
        text-align: center;
        font-size: 2.24rem;
        font-weight: bold;
        letter-spacing: 1px;
        margin-bottom: 35px;
        margin-top: 0;
        width: 100%;
    }
    .dodaj-zahtev-form-label {
        font-size: 1.13rem;
        font-weight: 500;
        margin-bottom: 3px;
        color: #232934;
        width: 180px;
        display: inline-block;
    }
    .dodaj-zahtev-row {
        margin-bottom: 13px;
        display: flex;
        align-items: center;
    }
    .dodaj-zahtev-input, .dodaj-zahtev-select {
        min-width: 230px;
        padding: 8px 14px;
        border-radius: 8px;
        border: 2px solid #8ca9bd;
        background: #a6bbc7;
        font-size: 1.09rem;
    }
    .dodaj-zahtev-date::-webkit-input-placeholder { color: #777; }
    .dodaj-zahtev-date::-moz-placeholder { color: #777; }
    .dodaj-zahtev-date:-ms-input-placeholder { color: #777; }
    .dodaj-zahtev-date::placeholder { color: #777; }
    .dodaj-zahtev-dugmici {
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
        .dodaj-zahtev-middle { padding: 40px 20px 0 20px; }
        .dodaj-zahtev-form-wrap { margin-left: 0; min-width: 0; width: calc(100vw - 40px); }
    }
</style>

<div class="dodaj-zahtev-middle">
    <div class="dodaj-zahtev-title">IZMENI ZAHTEV</div>
    <form method="POST" action="{{ route('zahtev.update', $zahtev->id) }}" class="dodaj-zahtev-form-wrap">
        @csrf
        @method('PUT')

        <div class="dodaj-zahtev-row">
            <label class="dodaj-zahtev-form-label" for="broj_zahteva">Broj zahteva:</label>
            <input id="broj_zahteva" name="broj_zahteva" class="dodaj-zahtev-input" type="text" value="{{ old('broj_zahteva', $zahtev->broj_zahteva ?? '') }}" />
        </div>

        <div class="dodaj-zahtev-row">
            <label class="dodaj-zahtev-form-label" for="opis">Opis:</label>
            <input id="opis" name="opis" class="dodaj-zahtev-input" type="text" value="{{ old('opis', $zahtev->opis ?? '') }}" />
        </div>

        <div class="dodaj-zahtev-row">
            <label class="dodaj-zahtev-form-label" for="tip_vestacenja">Tip veštačenja:</label>
            <select id="tip_vestacenja" name="tip_vestacenja" class="dodaj-zahtev-select">
                <option value="">Izaberite...</option>
                <option value="poljoprivredno" @if(old('tip_vestacenja', $zahtev->tip_vestacenja ?? '') == 'poljoprivredno') selected @endif>Poljoprivredno</option>
                <option value="procena_stete" @if(old('tip_vestacenja', $zahtev->tip_vestacenja ?? '') == 'procena_stete') selected @endif>Procena štete</option>
            </select>
        </div>

        <div class="dodaj-zahtev-row">
            <label class="dodaj-zahtev-form-label" for="lokacija">Lokacija:</label>
            <input id="lokacija" name="lokacija" class="dodaj-zahtev-input" type="text" value="{{ old('lokacija', $zahtev->lokacija ?? '') }}" />
        </div>

        <div class="dodaj-zahtev-row">
            <label class="dodaj-zahtev-form-label" for="datum_podnosenja">Datum podnošenja:</label>
            <input id="datum_podnosenja" name="datum_podnosenja" class="dodaj-zahtev-input dodaj-zahtev-date" type="date" value="{{ old('datum_podnosenja', $zahtev->datum_podnosenja ?? '') }}" />
        </div>

        <div class="dodaj-zahtev-row">
            <label class="dodaj-zahtev-form-label" for="hitnost">Hitnost:</label>
            <select id="hitnost" name="hitnost" class="dodaj-zahtev-select">
                <option value="">Izaberite...</option>
                <option value="visoka" @if(old('hitnost', $zahtev->hitnost ?? '') == 'visoka') selected @endif>Visoka</option>
                <option value="srednja" @if(old('hitnost', $zahtev->hitnost ?? '') == 'srednja') selected @endif>Srednja</option>
                <option value="niska" @if(old('hitnost', $zahtev->hitnost ?? '') == 'niska') selected @endif>Niska</option>
            </select>
        </div>

        <div class="dodaj-zahtev-row">
            <label class="dodaj-zahtev-form-label" for="status">Status:</label>
            <select id="status" name="status" class="dodaj-zahtev-select">
                <option value="">Izaberite...</option>
                <option value="u_obradi" @if(old('status', $zahtev->status ?? '') == 'u_obradi') selected @endif>U obradi</option>
                <option value="zavrsen" @if(old('status', $zahtev->status ?? '') == 'zavrsen') selected @endif>Završen</option>
                <option value="odbijen" @if(old('status', $zahtev->status ?? '') == 'odbijen') selected @endif>Odbijen</option>
            </select>
        </div>

        <div class="dodaj-zahtev-row">
            <label class="dodaj-zahtev-form-label" for="klijent_id">Klijent:</label>
            <select id="klijent_id" name="klijent_id" class="dodaj-zahtev-select">
                <option value="">Izaberite...</option>
                @foreach(($klijents ?? []) as $klijent)
                    <option value="{{ $klijent->id }}" @if((string)old('klijent_id', $zahtev->klijent_id ?? '') === (string)$klijent->id) selected @endif>
                        {{ $klijent->ime }} {{ $klijent->prezime }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="dodaj-zahtev-dugmici">
            <button class="dodaj-btn" type="submit">Sačuvaj izmene</button>
            <a href="{{ route('zahtevi') }}" class="odustani-btn">Odustani</a>
        </div>
    </form>
</div>
@endsection
