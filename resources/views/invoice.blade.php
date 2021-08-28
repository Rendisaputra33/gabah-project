<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />

    <!-- custom css -->
    <link rel="stylesheet" href="{{ asset('') }}css/invoice.css" />

    <!-- Icon Bootsstap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />

    <title>Invoice</title>
</head>

<body>
    <div class="container" id="cetak">
        <div class="border border-dark wrap">
            <div class="header">
                <h2>Penerimaan Gabah</h2>
                <hr />
            </div>
            <!-- Data Nama dan Tanggal -->
            <div class="tabble">
                <table>
                    <tr>
                        <th>Dari : {{ $nama }}</th>
                        <th>Tgl : {{ date('d-m-Y') }}</th>
                    </tr>
                    <tr>
                        <th>Nama : {{ $nama }}</th>
                        <th></th>
                    </tr>
                </table>
            </div>
            <!-- Akhir Data Nama dan Tanggal -->
            <!-- Tabel Isi Barang -->
            <div class="content">
                <table>
                    <tr>
                        <th>No</th>
                        <th style="border-bottom: none;">Berat (Kg)</th>
                        <th>Pot (%)</th>
                        <th>Total</th>
                    </tr>
                    @foreach ($datalist as $item)
                        <tr>
                            <td>{{ $item['no'] }}</td>
                            <td class="berat">
                                <p style="margin-bottom: 0; width: 125px; float: left;">
                                    @for ($i = 0; $i < count($item['berat']); $i++)
                                        {{ $item['berat'][$i] . ',' }}
                                    @endfor
                                </p>
                            </td>
                            <td>{{ $item['diskon'] }}</td>
                            <td>{{ $item['total'] }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th></th>
                        <th>{{ $total_kotor }}</th>
                        <th></th>
                        <th>{{ $afterpotongan }}</th>
                    </tr>
                </table>
            </div>
            <!-- Akhir Tabel Isi Barang -->

            <!-- Total -->
            <div class="pot">
                <div class="row justify-content-center mb-4">
                    <div class="col-4">
                        <p style="text-align: left; margin-left: 70px;">zak</p>
                    </div>
                    <div class="col-8">
                        <table>
                            <tr>
                                <td>{{ $countdata }} x 0.5 Kg</td>
                                <td>{{ $final_potongan }}</td>
                            </tr>
                            <tr>
                                <th>Total Gabah</th>
                                <th>{{ $total_gabah }}</th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mengtotal">
                <table class="submengtotal">
                    <tr>
                        <td style="text-align: left;">Bayar</td>
                        <td style="text-align: right;">{{ $total_gabah }} x {{ $harga }}</td>
                        <td style="text-align: right;" id="bayar"></td>
                        <input type="hidden" id="bayarvalue" value="{{ $bayar }}">
                    </tr>
                </table>
            </div>
            <!-- Akhir total -->
        </div>

    </div>

    <div class="container">
        <div class="row justify-content-center tombol">
            <div class="col-6">
                <!-- Tombol Print -->
                <a href="/home" class="btn btn-primary biru mb-2 tmbl">
                    <i class="bi bi-arrow-counterclockwise"></i> Kembali
                </a>
                <!-- Akhir Tombol Print -->
            </div>
            <div class="col-6" id="btn">
                <!-- Tombol Print -->
                <button type="button" class="btn btn-success mb-2 tmbl" id="tombol">
                    <i class="bi bi-printer"></i> Cetak
                </button>
                <!-- Akhir Tombol Print -->
            </div>
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="{{ asset('js/Checkout.js') }}"></script>
    <script>
        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : ''
                rupiah += separator + ribuan.join('.')
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
        }

        document.getElementById('bayar').innerHTML = formatRupiah(document.getElementById('bayarvalue').value, 'Rp.')

    </script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
</body>

</html>
