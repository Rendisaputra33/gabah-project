<div class="container">
    @extends('layouts.app')

    @section('css-home')
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link
            href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
            rel="stylesheet">
    @endsection

    @section('content')
        <div class="wrapper">
            <div class="header">
                <h2>PEMBELIAN GABAH</h2>
                <div class="header-icons">
                    <button id="modal" onClick="getmodal3()" class="header-icons" value="${data.kode_penerimaan}"><span
                            class="material-icons">add</span></button>
                    <button id="modal" onClick="getmodal2()" class="header-icons" value="${data.kode_penerimaan}"><span
                            class="material-icons-outlined">filter_alt</span></button>
                </div>
            </div>
            <div class="content">
                <table>
                    <tr>
                        <th>No</th>
                        <th>Nama Pengirim</th>
                        <th>Tanggal</th>
                        <th>Total Berat</th>
                        <th>Potongan</th>
                        <th>Harga Perkilo</th>
                        <th>Total Harga</th>
                        <th>Action</th>
                    </tr>
                    <tbody id="list-data">
                        {{-- content --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="w3-container">

        <div id="id02" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('id02').style.display='none'"
                        class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                </div>

                <form class="w3-container" action="">
                    <div class="w3-section">
                        <label><b>Tanggal Awal</b></label>
                        <input class="w3-input w3-border w3-margin-bottom" type="date" value="" id="tgl1" name="tanggal"
                            required>
                        <label><b>Tanggal Akhir</b></label>
                        <input class="w3-input w3-border w3-margin-bottom" type="date" value="" id="tgl2" name="tanggal"
                            required>

                        <button onclick="document.getElementById('id02').style.display='none'" type="button"
                            class="button-selesai">selesai</button>
                        <button class="button-text" type="button" onclick="filter()">Filter</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="id03" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('id03').style.display='none'"
                        class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                </div>

                <form class="w3-container" action="">
                    <div class="w3-section">
                        <label><b>Nama Pengirim</b></label>
                        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="" id="nama" required>
                        <label><b>Harga Gabah</b></label>
                        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="" id="harga" required>

                        <button onclick="document.getElementById('id03').style.display='none'" type="button"
                            class="button-selesai">selesai</button>
                        <button class="button-text" type="button" id="global">Input</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="id04" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('id04').style.display='none'"
                        class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                </div>
                <input type="hidden" id="kode" value="">
                <div class="w3-container">
                    <h3 class="modal-heading">Invoice</h3>
                    <table class="detail-table">

                        <tr>
                            <th>Berat</th>
                            <th>Potongan</th>
                            <th>Action</th>
                        </tr>
                        <tbody id="list-detail">
                            {{-- content --}}
                        </tbody>
                    </table>
                    <button id="modal" onClick="getmodal('${data.kode_penerimaan}')" value="${ data.kode_penerimaan }"
                        class="button-text modal" type="button">tambah</button>
                    <button class="button-text" type="button" id="cetak">Cetak</button>
                </div>
            </div>
        </div>
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('id01').style.display='none'"
                        class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                </div>

                <form class="w3-container" action="">
                    <div class="w3-section">
                        <input type="hidden" id="kodepenerimaan" value="">
                        <label><b>Berat</b></label>
                        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="" id="berat"
                            name="berat" required>

                        <button onclick="document.getElementById('id01').style.display='none'" type="button"
                            class="button-selesai">selesai</button>
                        <button class="button-text" type="button" id="add">Input</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="id05" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

            <div class="w3-center"><br>
                <span onclick="document.getElementById('id05').style.display='none'"
                    class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
            </div>

            <form class="w3-container" action="">
                <div class="w3-section">
                    <input type="hidden" value="" id="idpe">
                    <label><b>Potongan</b></label>
                    <input class="w3-input w3-border w3-margin-bottom" type="text" id="uppot" required>

                    <button onclick="document.getElementById('id05').style.display='none'" type="button"
                        class="button-selesai">selesai</button>
                    <button class="button-text" type="button" id="ude">Input</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('js/Data.js') }}"></script>
    <script src="{{ asset('js/Filter.js') }}"></script> -->

    <!-- Add font awesome icons to buttons (note that the fa-spin class rotates the icon)

@endsection
