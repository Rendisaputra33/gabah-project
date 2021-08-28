<div class="container">
    @extends('layouts.app')
    @section('css-drying')
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link
            href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
            rel="stylesheet">
    @endsection
    @section('content')
        <div class="wrapper">
            <div class="header">
                <h2>DATA PENYELEPAN</h2>
                <div class="header-icons">
                    <button class="header-icons" id="modal"
                        onclick="document.getElementById('id02').style.display='block'"><span
                            class="material-icons-outlined">wb_sunny</span></button>
                </div>
            </div>
            <div class="content">
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Nama Pengirim</th>
                        <th>Total Berat</th>
                        <th>Total Bayar</th>
                        <th>Tanggal Data</th>
                    </tr>
                    <tbody id="data-giling">
                        {{-- content --}}
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>

    <div id="id02" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

            <div class="w3-center"><br>
                <span onclick="document.getElementById('id02').style.display='none'"
                    class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
            </div>

            <form class="w3-container" action="">
                <div class="w3-section">
                    <label class="w3-margin-bottom"><b>Tanggal</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="date" id="tanggal" name="tanggal" required>
                    <label class="w3-margin-bottom"><b>Invoice</b></label>
                    <select class="w3-select w3-border w3-margin-bottom" id="selector">

                    </select>
                    <label class="w3-margin-bottom"><b>Berat</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="" id="berat" name="berat"
                        required>
                    <button class="button-text" type="button" id="selep">Input</button>
                    <button onclick="document.getElementById('id02').style.display='none'" type="button"
                        class="button-cancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/Giling.js') }}"></script>
@endsection
