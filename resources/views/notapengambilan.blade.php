<html>

<head>
    <meta charset="utf-8" />
    <title>Nota Pengambilan</title>
    <link rel="stylesheet" href="{{ asset('css/notapengambilan.css') }}" />
</head>

<body>
    <div class="navigation">
        <div class="tombol">
            <div class="tombol1"><a href="/pengambilan" class="my-button">Kembali</a></div>
            <div class="tombol1" style="margin-right: 0"><button id="btn-cetak">Cetak</button></div>
        </div>
    </div>
    <div id="cetak">

        <div class="wrapper">
            <article>
                <address>
                    <p>INVOICE : {{ $invoice }}</p>
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
                            <th style="width: 20%"><span>INVOICE</span></th>
                            <th style="width: 30%"><span>NAMA BARANG</span></th>
                            <th><span>HARGA BARANG</span></th>
                            <th><span>JUMLAH PENGAMBILAN</span></th>
                            <th><span>SISA BARANG</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $item)
                            <tr>
                                <td><span>{{ $item['inv'] }}</span></td>
                                <td><span>{{ $item['namab'] }}</span></td>
                                <td><span>{{ rupiah($item['harga']) }}</span></td>
                                <td><span>{{ $item['jumlah'] }}</span></td>
                                <td><span>{{ $item['sisa'] === 0 ? 'habis' : $item['sisa'] }}</span></td>
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
                    <p>Perhatian mohon untuk segera menyetak nota pengambilan barang karena nota hanya akan di cetak
                        satu
                        kali!</p>
                </div>
            </aside>
        </div>
    </div>
    <script src="{{ asset('js/cpenjualan.js') }}"></script>
</body>

</html>
