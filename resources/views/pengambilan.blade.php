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
                <h2>PENGAMBILAN GABAH</h2>
                <div class="header-icons">
                    <button id="modal" onclick="modalOpen()" class="header-icons"><span
                            class="material-icons">add</span></button>
                    <button id="modal" class="header-icons"><span class="material-icons-outlined">filter_alt</span></button>
                </div>
            </div>
            <div class="content">
                <table>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Nama Customer</th>
                        <th>Jumlah</th>
                        <th>Tanggal Pengambilan</th>
                    </tr>
                    <tbody id="list-data">
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $item['nama_barang'] }}</td>
                                <td>{{ $item['nama_customer'] }}</td>
                                <td>{{ $item['jumlah'] }}</td>
                                <td>{{ formatTanggal($item['tgl']) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="id01" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

            <div class="w3-center"><br>
                <span onclick="document.getElementById('id01').style.display='none'"
                    class="w3-button w3-xlarge w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
            </div>
            <input type="hidden" id="kode" value="">
            <div class="w3-container w3-margin-bottom">
                <table class="detail-table">
                    <tr>
                        <th>Invoice</th>
                        <th>Total Harga</th>
                        <th>Tanggal Pejualan</th>
                        <th>Action</th>
                    </tr>
                    <tbody id="list-detail">
                        {{-- content --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    <script src="{{ asset('js/GlobalPengambilan.js') }}"></script>
@endsection
