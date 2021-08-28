<html>

<head>
    <meta charset="utf-8" />
    <title>INVOICE</title>
    <link rel="stylesheet" href="{{ asset('css/invpenjualan.css') }}" />
</head>

<body>
    <div class="navigation">
        <div class="tombol">
            <div class="tombol1"><a href="/penjualan" class="my-button">Kembali</a></div>
            <div class="tombol1" style="margin-right: 0"><button id="btn-cetak">Cetak</button></div>
        </div>
    </div>
    <div id="cetak">

        <div class="wrapper">
            <article>
                <address>
                    <p>INVOICE : {{ $inv }}</p>
                </address>
                <table class="meta">
                    <tr>
                        <th><span>Pembeli</span></th>
                        <td><span>{{ $nama }}</span></td>
                    </tr>
                    <tr>
                        <th><span>Tanggal</span></th>
                        <td><span>{{ formatTanggal($tgl) }}</span></td>
                    </tr>
                </table>
                <table class="inventory">
                    <thead>
                        <tr>
                            <th style="width: 10%"><span>JUMLAH</span></th>
                            <th style="width: 40%"><span>NAMA BARANG</span></th>
                            <th><span>HARGA / PCS</span></th>
                            <th><span>HARGA</span></th>
                            <th><span>SUB TOTAL</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr>
                                <td><span>{{ $item['banyak_barang'] }}</span></td>
                                <td><span>{{ $item['nama_barang'] }}</span></td>
                                <td><span>{{ rupiah($item['pcs']) }}</span></td>
                                <td><span>{{ rupiah($item['harga']) }}</span></td>
                                <td><span>{{ rupiah($item['jumlah']) }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <table class="balance">
                    <tr>
                        <th><span>Total</span></th>
                        <td><span>{{ rupiah($total) }}</span></td>
                    </tr>
                </table>
            </article>
            <aside>
                <h1><span>Catatan Tambahan</span></h1>
                <div contenteditable>
                    <p>Tulis catatan tambahan disini</p>
                </div>
            </aside>
        </div>

    </div>
    <script src="{{ asset('js/cpenjualan.js') }}"></script>
</body>

</html>
