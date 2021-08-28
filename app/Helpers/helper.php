<?php

use App\Models\Barang;

function baseUrl()
{
    return url('/');
}

function getToken()
{
    return csrf_token();
}

function validate()
{
    if (session('username') == null) {
        return true;
    }
}

function isAdmin()
{
    return session('level') === 2 ? true : false;
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function formatTanggal($tgl)
{
    $listBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'November', 'Desember'];
    $bulan = explode('-', $tgl);
    $nobulan = (int) $bulan[1];
    return $bulan[2] . '/' . $listBulan[$nobulan] . '/' . $bulan[0];
}
