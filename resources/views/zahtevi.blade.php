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
    .sidebar-links .nav-link:nth-child(3) {
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
    .predmeti-content-middle {
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
        margin-bottom: 32px;
        margin-top: 0;
    }
    .predmeti-actions-row {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        width: 80vw;
        max-width: 1150px;
        gap: 22px;
        margin-bottom: 32px;
    }
    .predmeti-search-input {
        border-radius: 19px;
        width: 270px;
        background: #bfc8d2;
        border: 1.5px solid #99a4b6;
        padding: 7px 15px 7px 31px;
        outline: none;
        font-size: 1rem;
    }
    .predmeti-status-select {
        border-radius: 11px;
        background: #bfc8d2;
        border: 1.5px solid #99a4b6;
        min-width: 110px;
        padding: 4px 9px;
        font-size: 1rem;
    }
    .predmeti-action-btn {
        border-radius: 11px;
        background: #bfc8d2;
        border: 1.5px solid #99a4b6;
        min-width: 90px;
        padding: 4px 0;
        font-size: 1rem;
        transition: background .18s;
    }
    .predmeti-action-btn:hover {
        background: #bbc4d6;
    }
    .predmeti-add-btn {
        float: right;
        margin-left: auto;
        background: #bfc8d2;
        border: 1.5px solid #99a4b6;
        border-radius: 11px;
        font-size: 1rem;
        padding: 4px 20px;
        margin-bottom: 15px;
        transition: background .18s;
        text-decoration: none;
        color: #101820;
    }
    .predmeti-add-btn:hover,
    .predmeti-add-btn:focus,
    .predmeti-add-btn:active {
        background: #a9b5c6;
        text-decoration: none;
        color: #101820;
    }
    .predmeti-table-wrap {
        width: 80vw;
        max-width: 1150px;
        margin-bottom: 85px;
    }
    .custom-table {
        background: #9cb1bb;
        border-radius: 10px;
        min-width: 900px;
        min-height: 180px;
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
    .predmeti-btn-edit {
        border-radius: 7px;
        border: 1px solid #adb5ba;
        background: #e6e8e9;
        color: #222;
        font-weight: 500;
        font-size: .98rem;
        margin-right: 7px;
        padding: 2px 20px;
        transition: background .18s;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
    }
    .predmeti-btn-edit:focus, .predmeti-btn-edit:active {
        box-shadow: 0 0 3px #416cad44;
        outline: none;
        text-decoration: none;
    }
    .predmeti-btn-delete {
        border-radius: 7px;
        border: 1px solid #566979;
        background: #3b5467;
        color: #fff;
        font-weight: 500;
        font-size: .98rem;
        padding: 2px 18px;
        transition: background .18s;
    }
    .predmeti-btn-delete:hover,
    .predmeti-btn-edit:hover {
        background: #dbe5ef;
        color: #101c2e;
    }
    @media (max-width: 1300px) {
        .predmeti-table-wrap, .predmeti-actions-row { width: 95vw; min-width: 0; }
        .custom-table { min-width: 700px; }
    }
    @media (max-width: 991px) {
        .main-section { margin-left: 0; }
        .custom-table { min-width: 500px; }
        .predmeti-actions-row { flex-direction: column; align-items: flex-start; }
    }
    @media (max-width: 700px) {
        .custom-table, .predmeti-table-wrap { min-width: 0 !important; }
    }
</style>

<div class="sidebar-custom">
    <div class="sidebar-header">
        <h2>Sudski veštak</h2>
    </div>

    <div class="sidebar-links">
        <a href="{{ route('dashboard') }}" class="nav-link">POČETNA</a>
        <a href="{{ route('predmeti') }}" class="nav-link">PREDMETI</a>
        <a href="{{ route('zahtevi') }}" class="nav-link active">ZAHTEVI</a>
        <a href="{{ route('izvestaji') }}" class="nav-link">IZVEŠTAJI</a>
    </div>

    <form method="POST" class="logout-form" action="{{ route('logout') }}">
        @csrf
        <button class="logout-btn">ODJAVA</button>
    </form>
</div>

<div class="main-section">
    <div class="predmeti-content-middle">
        <div class="page-title">Zahtevi</div>

        <div class="predmeti-actions-row">
            <input type="text" class="predmeti-search-input" placeholder="🔍 Pretraga zahteva">
            <select class="predmeti-status-select">
                <option value="">Svi statusi</option>
                <option value="u_obradi">U obradi</option>
                <option value="zavrsen">Završen</option>
                <option value="odbijen">Odbijen</option>
            </select>
            <button class="predmeti-action-btn">Prikaži</button>
            @can('zahtev.create')
                <a href="{{ route('zahtev.create') }}" class="predmeti-add-btn" style="margin-left:auto;">Dodaj zahtev</a>
            @endcan
        </div>

        <div class="predmeti-table-wrap">
            <div class="custom-table p-2">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>Broj zahteva</th>
                            <th>Tip veštačenja</th>
                            <th>Datum podnošenja</th>
                            <th>Hitnost</th>
                            <th>Status</th>
                            <th>Opcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(($zahtevs ?? []) as $zahtev)
                            <tr>
                                <td>{{ $zahtev->broj_zahteva ?? '' }}</td>
                                <td>{{ $zahtev->tip_vestacenja ?? '' }}</td>
                                <td>{{ $zahtev->datum_podnosenja ?? '' }}</td>
                                <td>{{ $zahtev->hitnost ?? '' }}</td>
                                <td data-status="{{ $zahtev->status ?? '' }}">
                                    {{ [
                                        'u_obradi' => 'U obradi',
                                        'zavrsen' => 'Završen',
                                        'odbijen' => 'Odbijen',
                                    ][$zahtev->status ?? ''] ?? ($zahtev->status ?? '') }}
                                </td>
                                <td>
                                    @can('zahtev.update')
                                        <a href="{{ route('zahtev.edit', $zahtev->id) }}" class="predmeti-btn-edit">Izmeni</a>
                                    @endcan
                                    @can('zahtev.delete')
                                        <form method="POST" action="{{ route('zahtev.destroy', $zahtev->id) }}" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="predmeti-btn-delete">Obriši</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<script>
    (function () {
        const searchInput = document.querySelector('.predmeti-search-input');
        const statusSelect = document.querySelector('.predmeti-status-select');
        const applyBtn = document.querySelector('.predmeti-action-btn');
        const table = document.querySelector('.custom-table table');

        if (!searchInput || !statusSelect || !applyBtn || !table) return;

        const headerCells = Array.from(table.querySelectorAll('thead th'));
        const statusIndex = headerCells.findIndex((th) => (th.textContent || '').trim().toLowerCase() === 'status');

        const applyFilter = () => {
            const q = (searchInput.value || '').trim().toLowerCase();
            const status = (statusSelect.value || '').trim().toLowerCase();

            Array.from(table.querySelectorAll('tbody tr')).forEach((tr) => {
                const rowText = (tr.textContent || '').toLowerCase();
                const statusCell = statusIndex >= 0 ? tr.children[statusIndex] : null;
                const statusText = statusCell ? (((statusCell.getAttribute('data-status') || statusCell.textContent || '').trim().toLowerCase())) : '';
                const matchesSearch = !q || rowText.includes(q);
                const matchesStatus = !status || statusText === status;
                tr.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
            });
        };

        applyBtn.addEventListener('click', (e) => {
            e.preventDefault();
            applyFilter();
        });

        statusSelect.addEventListener('change', applyFilter);

        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                applyFilter();
            }
        });
    })();
</script>
@endsection
