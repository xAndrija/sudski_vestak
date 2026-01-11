@extends('layouts.bootstrap')

@section('content')
<style>
    body { background: #ccd2d9 !important; }
    .sidebar-custom {
        min-height: 100vh;
        background: #60798a;
        width: 210px;
        padding-top: 50px;
        padding-bottom: 30px;
        position: fixed;
        top: 0; left: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        z-index: 10;
    }
    .sidebar-header {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 44px;
        padding-left: 27px;
        padding-right: 27px;
    }
    .sidebar-header h2 {
        color: #101820;
        font-size: 2rem;
        font-weight: bold;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        padding: 0;
        margin: 0;
    }
    .sidebar-links {
        width: 100%;
        flex: 1 0 auto;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        gap: 38px;
        margin-top: 35px;
        margin-bottom: 12px;
    }
    .sidebar-custom .nav-link {
        width: 90%;
        border-radius: 18px;
        font-size: 1.19rem;
        padding: 11px 0 11px 0;
        color: #101820;
        background: #acbbc6;
        text-align: center;
        font-weight: 500;
        text-decoration: none;
        transition: background .2s;
        margin: 0 !important;
        box-sizing: border-box;
        border: none;
    }
    .sidebar-custom .nav-link.active,
    .sidebar-custom .nav-link:hover {
        background: #366185;
        color: #fff;
    }
    .sidebar-links .nav-link:first-of-type {
        background: #366185;
        color: #fff;
        border: 2px solid #244566;
    }
    .sidebar-links .nav-link {
        cursor: pointer;
    }
    .sidebar-custom .logout-form {
        width: 100%;
        margin-top: auto;
        display: flex;
        justify-content: center;
        align-items: end;
    }
    .logout-btn {
        width: 64%;
        border-radius: 14px;
        background: #b5bec4;
        color: #101820;
        font-weight: 600;
        border: none;
        padding: 5px 0;
        margin-bottom: 17px;
        margin-top: 0;
        font-size: 0.93rem;
        transition: background .2s;
    }
    .logout-btn:hover { background:#455e74; color: #fff; }
    .main-section {
        min-height: 100vh;
        margin-left: 210px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }
    .dashboard-content-middle {
        flex: 1;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 80vh;
    }
    .page-title {
        text-align: center;
        font-size: 2.3rem;
        font-weight: bold;
        margin-bottom: 6px;
    }
    .subtitle {
        text-align: center;
        font-size: 1.22rem;
        font-weight: 500;
        margin-bottom: 38px;
    }
    .table-row {
        display: flex;
        justify-content: center;
        gap: 60px;
        width: 100%;
        margin-top: 35px;
    }
    .table-title {
        font-size: 1.18rem;
        text-align: center;
        font-weight: 500;
        margin-bottom: 8px;
    }
    .custom-table {
        background: #9cb1bb;
        border-radius: 10px;
        min-width: 330px;
        min-height: 226px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,.06);
        margin: 0 auto;
    }
    .custom-table .table {
        border-radius: 7px;
        border-collapse: separate;
        border-spacing: 0;
        overflow: hidden;
    }
    thead th {
        background: #b7c8d6;
        font-weight: 600;
        text-align: center;
        font-size: 1rem;
        padding: 8px;
        border: 1.5px solid #8296a5;
    }
    .custom-table tbody tr td {
        text-align: center;
        padding: 13px 8px 12px 8px;
        font-size: 1.05rem;
        border: 1.5px solid #8296a5;
        background: rgba(255,255,255,0.11);
    }
    @media (max-width: 1100px) {
        .table-row { flex-direction: column; align-items: center; gap: 32px; }
        .main-section { margin-left: 0; }
    }
</style>
<div class="sidebar-custom">
    <div class="sidebar-header">
        <h2>Sudski veštak</h2>
    </div>
    <div class="sidebar-links">
        <a href="{{ route('dashboard') }}" class="nav-link active">POČETNA</a>
        <a href="{{ route('predmeti') }}" class="nav-link">PREDMETI</a>
        <a href="{{ route('zahtevi') }}" class="nav-link">ZAHTEVI</a>
        <a href="{{ route('izvestaji') }}" class="nav-link">IZVEŠTAJI</a>
    </div>
    <form method="POST" class="logout-form" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="logout-btn">ODJAVA</button>
    </form>
</div>
<div class="main-section">
    <div class="dashboard-content-middle">
        <div class="page-title">Digitalna platforma za veštake</div>
        <div class="subtitle">Dobrodošli u sistem za sudsko veštačenje</div>
        <div class="table-row">
            <div>
                <div class="table-title">Novi predmeti</div>
                <div class="custom-table p-2">
                    <table class="table mb-0">
                        <thead><tr>
                            <th>Broj predmeta</th><th>Rok izrade</th><th>Status</th>
                        </tr></thead>
                        <tbody>
                            @forelse(($predmeti ?? []) as $predmet)
                                <tr>
                                    <td>{{ $predmet->broj ?? '' }}</td>
                                    <td>{{ $predmet->rok ?? '' }}</td>
                                    <td>{{ $predmet->status_label ?? '' }}</td>
                                </tr>
                            @empty
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div>
                <div class="table-title">Novi izveštaji</div>
                <div class="custom-table p-2">
                    <table class="table mb-0">
                        <thead><tr>
                            <th>Naziv</th><th>Datum</th><th>Status</th>
                        </tr></thead>
                        <tbody>
                            @forelse(($izvestaji ?? []) as $izvestaj)
                                <tr>
                                    <td>{{ $izvestaj->naziv ?? '' }}</td>
                                    <td>{{ $izvestaj->datum ?? '' }}</td>
                                    <td>{{ $izvestaj->status ?? '' }}</td>
                                </tr>
                            @empty
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                                <tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
