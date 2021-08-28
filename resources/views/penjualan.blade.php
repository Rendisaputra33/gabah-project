<div class="container">@extends('layouts.app')
    @section('css-drying')
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    @endsection
    @section('content')
        <div class="wrapper">
            <div class="header">
                <h2>DATA PENJUALAN</h2>

                <div class="header-icons">
                    <button class="header-icons" id="modal" onclick="modalGlobal()"><span class="material-icons">add</span></button>
                </div>
            </div>
            <div class="content">
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Invoice</th>
                        <th>Customer</th>
                        <th>Total Harga</th>
                        <th>Tanggal Penjualan</th>
                        <th>Action</th>
                    </tr>
                    <tbody id="list-data">

                    </tbody>
                </table>
            </div>
        </div>
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:700px">

                <div class="w3-center"><br>
                    <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                </div>
                <div class="w3-container">
                    <table class="detail-table">
                        <tr>
                            <th>Nama Barang</th>
                            <th>Nama Customer</th>
                            <th>Jumlah</th>
                            <th>Harga / PCS</th>
                            <th>Total Harga</th>
                        </tr>
                        <tbody id="list-detail">
                            {{-- content --}}
                        </tbody>
                    </table>
                    <button class="button-text" type="button" id="cetak">Cetak</button>
                    <button class="button-text" type="button" id="modal" onclick="modalAdd()">Tambah</button>
                    <div id="id03" class="w3-modal">
                        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

                            <div class="w3-center"><br>
                                <span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                            </div>
                            <div class="w3-container">
                                <form class="w3-container" action="">
                                    <div class="w3-section">
                                        <input type="hidden" id="customer" value="">
                                        <input type="hidden" id="inv" value="">
                                        <label><b>Nama Barang</b></label>
                                        <select class="w3-select w3-border w3-margin-bottom" id="barangSelect" name="barang">
                                        </select>
                                        <label><b>Jumlah</b></label>
                                        <input class="w3-input w3-border w3-margin-bottom" type="text" placeholder="" id="jumlah" name="jumlah" required>
                                        <label><b>Tanggal Penjualan</b></label>
                                        <input class="w3-input w3-border w3-margin-bottom" type="date" name="tanggal" required>
                                        <button class="button-text" type="button" onclick="addDetail()">Input</button>
                                        <button onclick="document.getElementById('id03').style.display='none'" type="button" class="button-cancel">Cancel</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="id00" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
            <div class="w3-center"><br>
                <span onclick="document.getElementById('id00').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
            </div>
            <div class="w3-container">
                <form class="w3-container" action="">
                    <div class="w3-section">
                        <label><b>Tanggal Penjualan</b></label>
                        <input class="w3-input w3-border w3-margin-bottom" type="date" name="tgl" required>
                        <label><b>Nama Customer</b></label>
                        <select class="w3-select w3-border w3-margin-bottom" id="customerSelect" name="customeradd">

                        </select>
                        <button class="button-text" type="button" onclick="addPenjualan()">Input</button>
                        <button class="button-text" type="button" onclick="document.getElementById('id04').style.display='block'">Tambah</button>
                        <button onclick="document.getElementById('id02').style.display='none'" type="button" class="button-cancel">Cancel</button>
                    </div>
                </form>
                <div id="id04" class="w3-modal">
                    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">
                        <div class="w3-center"><br>
                            <span onclick="document.getElementById('id04').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                        </div>
                        <div class="w3-container">
                            <form class="w3-container" action="">
                                <div class="w3-section">
                                    <label><b>Nama</b></label>
                                    <input class="w3-input w3-border w3-margin-bottom" type="text" id="nama" required>
                                    <label><b>Alamat</b></label>
                                    <input class="w3-input w3-border w3-margin-bottom" type="text" id="alamat" required>
                                    <label><b>No Telp</b></label>
                                    <input class="w3-input w3-border w3-margin-bottom" type="text" id="no_telp" required>
                                    <button class="button-text" type="button" onclick="addCustomer()">Tambah</button>
                                    <button onclick="document.getElementById('id04').style.display='none'" type="button" class="button-cancel">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('js/Penjualan.js') }}"></script>
@endsection
