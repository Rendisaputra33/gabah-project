<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function getBarang()
    {
        return Barang::get();
    }

    public function updateBarang($data, $id)
    {
        return Barang::where('id_barang', $id)->update($data)
            ? redirect('/admin/barang')->with('success', 'update barang berhasil')
            : redirect('/admin/barang')->with('error', 'update barang gagal');
    }

    public function addBarang(array $data)
    {
        return Barang::insert($data)
            ? redirect('/admin/barang')->with('success', 'tambah barang berhasil')
            : redirect('/admin/barang')->with('error', 'tambah barang gagal');
    }

    public function deleteBarang($id)
    {
        return Barang::where('id_barang', $id)->delete()
            ? redirect('/admin/barang')->with('success', 'hapus barang berhasil')
            : redirect('/admin/barang')->with('error', 'hapus barang gagal');
    }

    public function getUpdate($id)
    {
        return response()->json([
            'data' => Barang::where('id_barang', $id)->first()
        ]);
    }
}
