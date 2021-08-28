<?php

namespace App\Http\Controllers;

use App\Models\Pengambilan as ModelsPengambilan;
use App\Models\Penjualan;
use App\Http\Controllers\PenjualanController;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\DPenjualan;
use App\Models\Temp;
use Illuminate\Http\Request;

class Pengambilan extends Controller
{
    private $excontrller;

    public function __construct()
    {
        $this->excontrller = new PenjualanController();
    }

    public function index()
    {
        $final = [];
        $data = ModelsPengambilan::whereDate('tgl_pengambilan', now())->get();

        foreach ($data as $item) {
            $final[] = [
                'nama_customer' => $this->getCustomername($item->noinvoice),
                'nama_barang' => $this->getBarangname($item->id_penjualan),
                'jumlah' => $item->jumlah_pengambilan,
                'tgl' => $item->tgl_pengambilan
            ];
        }

        // dd($data);

        return view('pengambilan', [
            'data' => $final
        ]);
    }

    public function getBarangname($id)
    {
        $dp = DPenjualan::where('id_detail_penjualan', $id)->first();
        $barang = Barang::select('nama')->where('id_barang', $dp['id_barang'])->first()['nama'];
        return $barang;
    }

    public function getCustomername($invoice)
    {
        $id = Penjualan::select('customer')->where('invoice_penjualan', $invoice)->first()['customer'];
        return $id === 0 ? 'umum' : Customer::select('nama')->where('id_customer', $id)->first()['nama'];
    }

    public function addPengambilan($inv)
    {
        $invoice = str_replace('-', '/', $inv);
        $data = $this->excontrller->getDetail($invoice)->original;
        return view('checkout', [
            'data' => $data['data'], 'inv' => $invoice
        ]);
    }

    public function getJumlah($id)
    {
        $data = DPenjualan::select('sisa', 'invoice_penjualan', 'id_detail_penjualan')->where('id_detail_penjualan', $id)->first();
        return response()->json(['jumlah' => $data]);
    }

    public function getPenjualan()
    {
        return response()->json(['data' => Penjualan::get()]);
    }

    public function savePengambilan(Request $req)
    {
        $idToDelete = [];
        $data = Temp::where('noinvoice', $req->inv)->get();

        foreach ($data as $item) {
            if (ModelsPengambilan::insert([
                'noinvoice' => $item->noinvoice,
                'id_penjualan' => $item->id_detail_penjualan,
                'jumlah_pengambilan' => $item->jumlah_pengambilan,
                'tgl_pengambilan' => now(),
                'tgl_data' => now()
            ])) {
                array_push($idToDelete, $item->id_temp);
            } else {
                return redirect("/pengambilan")->with("error", "gagal cetak nota");
            };
        }

        if (Temp::whereIn('id_temp', $idToDelete)->delete()) {
            $dataNota = $this->generateDatanota($req->inv, $data);
            return view("notapengambilan", $dataNota);
        };
    }

    public function saveTemp(Request $req)
    {
        $insert = Temp::insert([
            'noinvoice' => $req->inv,
            'id_detail_penjualan' => $req->id,
            'jumlah_pengambilan' => $req->jumlah
        ]);

        if ($insert) {
            $data = DPenjualan::where('id_detail_penjualan', $req->id)->first();
            return DPenjualan::where('id_detail_penjualan', $req->id)->update(['sisa' => $data['sisa'] - $req->jumlah]) ? response()->json(['ok']) : response()->json(['not ok']);
        }
    }

    public function generateDatanota($inv, $data)
    {
        $detail = [];
        $total = 0;

        foreach ($data as $key) {
            $dataDetail = $this->splitData($key['id_detail_penjualan']);
            $total += $key['jumlah_pengambilan'] * $dataDetail->hrg_jual;
            $detail[] = [
                'namab' => $dataDetail->nama,
                'jumlah' => $key['jumlah_pengambilan'],
                'inv' => $inv,
                'harga' => $dataDetail->hrg_jual,
                'sisa' => $dataDetail->sisa
            ];
        }

        $dataName = Penjualan::select('customer', 'tanggal_penjualan')->where('invoice_penjualan', $inv)->first();
        $masterName = $dataName['customer'] === 0 ? 'umum' : Customer::select('nama')->where('id_customer', $dataName['customer'])->first()['nama'];

        return ["list" => $detail, "total" => $total, "nama" => $masterName, "invoice" => $inv, 'tgl' => $dataName['tanggal_penjualan']];
    }

    public function splitData($id)
    {
        return DPenjualan::join('tb_barang', 'tb_detail_penjualan.id_barang', '=', 'tb_barang.id_barang')->where('id_detail_penjualan', $id)->first();
    }

    public function allPenjualan()
    {
        $data = Penjualan::get();
        return response()->json(['data' => $data]);
    }
}
