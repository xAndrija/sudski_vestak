@extends('layouts.bootstrap')

@section('content')
<style>
    body { background: #ccd2d9 !important; }
    .dodaj-izvestaj-middle {
        width: 100%;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        justify-content: flex-start;
        padding: 60px 0 0 0;
        box-sizing: border-box;
    }
    .dodaj-izvestaj-form-wrap {
        display: flex;
        flex-direction: column;
        justify-content: center;
        gap: 18px;
        min-width: 570px;
        margin-left: 120px;
    }
    .dodaj-izvestaj-title {
        text-align: center;
        font-size: 2.24rem;
        font-weight: bold;
        letter-spacing: 1px;
        margin-bottom: 35px;
        margin-top: 0;
        width: 100%;
    }
    .dodaj-izvestaj-form-label {
        font-size: 1.13rem;
        font-weight: 500;
        margin-bottom: 3px;
        color: #232934;
        width: 180px;
        display: inline-block;
    }
    .dodaj-izvestaj-row {
        margin-bottom: 13px;
        display: flex;
        align-items: center;
    }
    .dodaj-izvestaj-input, .dodaj-izvestaj-select, .dodaj-izvestaj-textarea {
        min-width: 230px;
        padding: 8px 14px;
        border-radius: 8px;
        border: 2px solid #8ca9bd;
        background: #a6bbc7;
        font-size: 1.09rem;
    }
    .dodaj-izvestaj-textarea {
        min-height: 90px;
        resize: vertical;
    }
    .dodaj-izvestaj-date::-webkit-input-placeholder { color: #777; }
    .dodaj-izvestaj-date::-moz-placeholder { color: #777; }
    .dodaj-izvestaj-date:-ms-input-placeholder { color: #777; }
    .dodaj-izvestaj-date::placeholder { color: #777; }
    .dodaj-izvestaj-dugmici {
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
        .dodaj-izvestaj-middle { padding: 40px 20px 0 20px; }
        .dodaj-izvestaj-form-wrap { margin-left: 0; min-width: 0; width: calc(100vw - 40px); }
    }
</style>

<div class="dodaj-izvestaj-middle">
    <div class="dodaj-izvestaj-title">IZMENI IZVEŠTAJ</div>
    <form method="POST" action="{{ route('izvestaj.update', $izvestaj->id) }}" class="dodaj-izvestaj-form-wrap">
        @csrf
        @method('PUT')

        <div class="dodaj-izvestaj-row">
            <label class="dodaj-izvestaj-form-label" for="naziv">Naziv:</label>
            <input id="naziv" name="naziv" class="dodaj-izvestaj-input" type="text" value="{{ old('naziv', $izvestaj->naziv ?? '') }}" />
        </div>

        <div class="dodaj-izvestaj-row">
            <label class="dodaj-izvestaj-form-label" for="sadrzaj">Sadržaj:</label>
            <textarea id="sadrzaj" name="sadrzaj" class="dodaj-izvestaj-textarea">{{ old('sadrzaj', $izvestaj->sadrzaj ?? '') }}</textarea>
        </div>

        <div class="dodaj-izvestaj-row">
            <label class="dodaj-izvestaj-form-label" for="datum">Datum kreiranja:</label>
            <input id="datum" name="datum" class="dodaj-izvestaj-input dodaj-izvestaj-date" type="date" value="{{ old('datum', $izvestaj->datum ?? '') }}" />
        </div>

        <div class="dodaj-izvestaj-row">
            <label class="dodaj-izvestaj-form-label" for="pdf_putanja">PDF putanja:</label>
            <input id="pdf_putanja" name="pdf_putanja" class="dodaj-izvestaj-input" type="text" value="{{ old('pdf_putanja', $izvestaj->pdf_putanja ?? '') }}" />
        </div>

        <div class="dodaj-izvestaj-row">
            <label class="dodaj-izvestaj-form-label" for="status">Status:</label>
            <select id="status" name="status" class="dodaj-izvestaj-select">
                <option value="">Izaberite...</option>
                <option value="u_izradi" @if(old('status', $izvestaj->status ?? '') == 'u_izradi') selected @endif>U izradi</option>
                <option value="zavrsen" @if(old('status', $izvestaj->status ?? '') == 'zavrsen') selected @endif>Završen</option>
                <option value="poslat" @if(old('status', $izvestaj->status ?? '') == 'poslat') selected @endif>Poslat</option>
            </select>
        </div>

        <div class="dodaj-izvestaj-dugmici">
            <button class="dodaj-btn" type="submit">Sačuvaj izmene</button>
            <a href="{{ route('izvestaji') }}" class="odustani-btn">Odustani</a>
        </div>
    </form>
</div>
@endsection
