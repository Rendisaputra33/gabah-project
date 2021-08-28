<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Customer;
use App\Models\DPenjualan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{

    private function makeId()
    {
        $last = Penjualan::latest()->first();
        $pecah = $last === null ? 0 : explode("/", $last['id_penjualan']);
        $parseid = $last === null ? 0 : (int) $pecah[0];
        return "{$this->makeZero($parseid)}/INV/{$this->getMounth(date('m'))}/" . date('Y');
    }

    public function makeZero($id)
    {
        if ($id < 9) {
            return '00' . ($id += 1);
        } elseif ($id < 99) {
            return '0' . ($id += 1);
        } else {
            return $id += 1;
        }
    }

    public function getMounth($intMounth)
    {
        $im = (int) $intMounth;
        $mounth = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        return $mounth[$im - 1];
    }

    public function index()
    {
        return view('penjualan');
    }

    public function addPenjualan(Request $req)
    {
        return Penjualan::insert([
            'invoice_penjualan' => $this->makeId(),
            'total_harga' => 0,
            'customer' => $req->customer,
            'tanggal_penjualan' => $req->tgl,
            'tgl_data' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]) ? response()->json(['status' => 'ok']) : response()->json(['status' => 'no']);
    }

    public function addDetail(Request $req)
    {
        $tothar = Barang::select('hrg_jual')->where('id_barang', $req->barang)->first()['hrg_jual'];

        $insert = DPenjualan::insert([
            'invoice_penjualan' => $req->inv,
            'id_barang' => $req->barang,
            'id_customer' => $req->customer,
            'jumlah' => $req->jumlah,
            'sisa' => $req->jumlah,
            'total_harga' => $tothar * $req->jumlah,
            'tgl_detail' => now(),

            'total_harga' => $tothar * $req->jumlah,
            'tgl_detail' => $req->tgl,
            'tgl_data' => now()
        ]);

        if ($insert) {
            return Penjualan::where('invoice_penjualan', $req->inv)->update([
                'total_harga' => Penjualan::select('total_harga')->where('invoice_penjualan', $req->inv)->first()['total_harga'] += $req->jumlah * $tothar
            ]) ? response()->json(['status' => 'ok']) : response()->json(['status' => 'no']);
        } else {
            return response()->json(['status' => 'no']);
        }
    }

    public function getDetail($inv)
    {
        $invoice = str_replace('-', '/', $inv);
        $data = DPenjualan::where('invoice_penjualan', $invoice)->get();
        $final = array();
        foreach ($data as $item) {
            $barang = $this->pcsBarang($item->id_barang);
            $final[] = [
                'id' => $item->id_detail_penjualan,
                'id_b' => $item->id_barang,
                'inv_penjualan' => $item->invoice_penjualan,
                'namab' => $barang['nama'],
                'namab' => Barang::select('nama')->where('id_barang', $item->id_barang)->first()['nama'],
                'namac' => $item->id_customer === 0 ? "umum" : Customer::select('nama')->where('id_customer', $item->id_customer)->first()['nama'],
                'jumlah' => $item->jumlah,
                'pcs' => $barang['hrg_jual'],
                'harga' => $item->total_harga,
                'sisa' => $item->sisa
            ];
        }
        return response()->json(['data' => $final]);
    }

    public function pcsBarang($id)
    {
        return Barang::select('nama', 'hrg_jual')->where('id_barang', $id)->first();
    }

    public function getCustomer()
    {
        return response()->json([
            'data' => Customer::get()
        ]);
    }

    public function getBarang()
    {
        return response()->json([
            'data' => Barang::get()
        ]);
    }

    public function printInv($inv)
    {
        $invoice = str_replace('-', '/', $inv);
        $datalist = array();
        $list = DPenjualan::where('invoice_penjualan', $invoice)->get();
        foreach ($list as $item) {
            $nama = Barang::select('nama', 'satuan', 'kemasan', 'hrg_jual')->where('id_barang', $item->id_barang)->first();
            $datalist[] = [
                'banyak_barang' => $item->jumlah,
                'nama_barang' => $nama['nama'] . ' ' . $nama['kemasan'] . ' ' . $nama['satuan'],
                'harga' => $item->total_harga,
                'jumlah' => $item->total_harga,
                'pcs' => $nama['hrg_jual']
            ];
        }
        $cus = Penjualan::select('customer')->where('invoice_penjualan', $invoice)->first()['customer'];
        return view('invpenjualan', [
            'list' => $datalist,
            'total' => $this->sum($datalist),
            'inv' => $invoice,
            'nama' =>  $cus === 0 ? 'umum' : $nama = Customer::select('nama')->where('id_customer', $cus)->first()['nama'],
            'tgl' => Penjualan::select('tanggal_penjualan')->where('invoice_penjualan', $invoice)->first()['tanggal_penjualan']
        ]);
    }

    public function sum(array $arr)
    {
        $jumlah = 0;
        foreach ($arr as $item) {
            $jumlah += $item['jumlah'];
        }
        return $jumlah;
    }

    public function getAll()
    {
        $data = [];
        foreach (Penjualan::get() as $key) {
            $data[] = [
                'namaCustomer' => $key->customer != 0 ? Customer::select('nama')->where('id_customer', $key->customer)->first()['nama'] : "umum",
                'invoice_penjualan' => $key->invoice_penjualan,
                'total_harga' => $key->total_harga,
                'tanggal_penjualan' => $key->tanggal_penjualan,
                'customer' => $key->customer
            ];
        }
        return response()->json(['data' => $data]);
    }

    public function addCustomer(Request $req)
    {
        return Customer::insert(['nama' => $req->anama, 'alamat' => $req->aalamat, 'no_telp' => $req->ano])
            ? response()->json(["ok"])
            : response()->json(["not ok"]);
    }
}
