<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <title></title>
</head>

<body>
    <input type="hidden" name="url" id="baseurl" value="{{ baseUrl() }}">
    <input type="hidden" name="token" id="token" value="{{ csrf_token() }}">
    <div class="container checkout">
        <div class="wrapper checkout">
            <div class="content">
                <table>
                    <tr>
                        <th>No</th>
                        <th>No Invoice</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Action</th>
                    </tr>
                    <tbody id="list-data">
                        <?php $no = 1; ?>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $item['inv_penjualan'] }}</td>
                                <td>{{ $item['namab'] }}</td>
                                <td>{{ $item['sisa'] }}</td>
                                <td>
                                @if ($item['sisa'] === 0) barang telah habis @else
                                        <button id="modal" onclick="getAdd('{{ $item['id'] }}')" class="header-icons"
                                            value="${data.kode_penerimaan}"><span
                                                class="material-icons-outlined">back_hand</span></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        {{-- content --}}
                    </tbody>
                </table>
                <div class="header-icons">
                    <form action="/pengambilan/action/update" method="post">
                        @csrf
                        <input type="hidden" name="inv" value="{{ $inv }}">
                        <button class="button-text" type="submit">Cetak</button>
                        <button class="button-cancel" type="button" id="kembali">Kembali</button>
                    </form>
                </div>
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
                    <label><b>Jumlah Pengambilan</b></label>
                    <input type="hidden" id="inv">
                    <input type="hidden" id="id">
                    <input class="w3-input w3-border w3-margin-bottom" type="text" id="jumlah" required>
                    <button class="button-text" type="button" id="ambil">Input</button>
                    <button onclick="document.getElementById('id01').style.display='none'" type="button"
                        class="button-cancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/Pengambilan.js') }}"></script>

</body>

</html>
