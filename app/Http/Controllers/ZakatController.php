<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use App\Models\Giling;
use App\Models\Kering;
use App\Models\Penerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class ZakatController extends Controller
{
    /**
     * get data detail gabah
     * @return json data detail
     */
    public function getChart($id)
    {
        $data = Detail::where('kode_penerimaan', $id)->get();
        $bio = Penerimaan::select('kode_penerimaan', 'harga')->where('kode_penerimaan', $id)->get();
        return response()->json(['pesan' => 'success', 'data' => $data, 'iden' => $bio]);
    }

    /**
     * get data gabah kering 
     * @return json data gabah kering
     */
    public function getGabahk()
    {
        $data = Kering::get();
        return response()->json(['pesan' => 'success', 'data' => $data]);
    }


    /**
     * add data detail gabah
     * @param Request
     * @return json data
     */
    public function addChart(Request $req)
    {
        $insert = Detail::insert(['kode_penerimaan' => $req->kode_penerimaan, 'berat' => $req->berat, 'potongan' => 0, 'potongan_zak' => 0.5, 'berat_total' => $req->berat, 'bayar' => 0, 'tgl_data' => now(), 'updated_at' => now()]);

        if ($insert) {
            $p = Penerimaan::where('kode_penerimaan', $req->kode_penerimaan)->first();

            return Penerimaan::where('kode_penerimaan', $req->kode_penerimaan)->update([
                'berat_kotor' => $p['berat_kotor'] += $req->berat,
                'total_potongan' => $p['total_potongan'] += 0.5,
                'total_berat' => $p['total_berat'] += $req->berat,
                'total_bayar' => $p['total_bayar'] += $req->berat * $p['harga'],
                'updated_at' => now()
            ]) ? response()->json('sukses') : response()->json('gagal');
        }
        return response()->json('gagal');
    }

    /**
     * @return json data
     */
    public function getGabah()
    {
        if (validate()) {
            abort('401', 'login required');
        }

        $data = Penerimaan::whereDate('tgl_data', now())->orderBy('id_penerimaan', 'desc')->get();
        return response()->json(['pesan' => 'sukses', 'data' => $data]);
    }

    public function getGkering()
    {
        return view('drying');
    }

    /**
     * @return Renderable
     */
    public function viewAdd()
    {
        if (validate()) {
            abort('401', 'login required');
        }

        return view('add', ['title' => 'Halaman | Tambah Data']);
    }

    /**
     * @param Request
     * @return json data
     */
    public function addGabah(Request $req)
    {
        if (validate()) {
            abort('401', 'login required');
        }

        $insert = Penerimaan::insert(['kode_penerimaan' => $req->kode, 'nama_gabah' => $req->nama, 'tanggal' => now(), 'berat_kotor' => 0, 'total_potongan' => 0, 'total_pot_zak' => 0.5, 'total_berat' => 0, 'harga' => $req->bayar, 'total_bayar' => 0, 'tgl_data' => now(), 'updated_at' => now()]);

        if ($insert) {
            return response()->json(['pesan' => 'success', 'status' => 200]);
        }
        return response()->json(['pesan' => 'failed']);
    }


    /**
     * function calculate mastering data
     * @return Renderable & array
     */
    public function updateGabah(Request $req)
    {
        $dataList = [];
        $harga = Penerimaan::select('harga')->where('kode_penerimaan', $req->kode)->first();
        $totalkotor = 0;
        $totalpot = 0;
        $afterpotongan = 0;
        $data = Detail::where('kode_penerimaan', $req->kode)->get();
        $countdata = count($data);
        $pot = 0.5;
        $no = 1;

        foreach ($data as $item) {
            $dataList[] = ['berat' => $item['berat'], 'potongan' => $item['potongan'], 'total' => $this->calculate($item['berat'], $item['potongan'])];
            $totalpot += $this->topot($item['berat'], $item['potongan']);
            $totalkotor += $item['berat'];
            $afterpotongan += $this->calculate($item['berat'], $item['potongan']);
        }

        $potonganakhir = $countdata * $pot;
        $datadiri = $this->getNama($req->kode);
        $list = $this->midsetup(count($this->Middle($req->kode)), $this->Middle($req->kode));
        $da = $this->Middle($req->kode);
        $arr = [];
        $berat = [];

        for ($i = 0; $i < count($list); $i++) {
            $arr[] = $da[$i][$list[$i]];
        }

        foreach ($arr as $i) {
            $jml = array_sum($i['berat']);
            $berat[] = ['no' => $no++, 'berat' => $i['berat'], 'diskon' => $i['diskon'], 'total' => $jml - $jml * $i['diskon'] / 100];
        }

        $alldata = ['nama' => $datadiri['nama_gabah'], 'tanggal' => $datadiri['tgl_data'], 'datalist' => $berat, 'total_kotor' => $totalkotor, 'afterpotongan' => $afterpotongan, 'countdata' => $countdata, 'potongan_zak' => $pot, 'final_potongan' => $potonganakhir, 'total_gabah' => $afterpotongan - $potonganakhir, 'bayar' => ($afterpotongan - $potonganakhir) * $harga['harga'], 'harga' => $harga['harga']];

        $update = Penerimaan::where('kode_penerimaan', $req->kode)->update([
            'berat_kotor' => $alldata['total_kotor'],
            'total_potongan' => $totalpot,
            'total_pot_zak' => $potonganakhir,
            'total_berat' => $alldata['afterpotongan'],
            'total_bayar' => $alldata['bayar'],
        ]);

        if ($update) {
            return view('invoice', $alldata);
        }
        return redirect('/home');
    }

    /**
     * function calculate total bayar
     * @return Int value
     */
    public function calculate($berat, $item)
    {
        $res1 = $berat * $item / 100;
        $finalres = $berat - $res1;

        return $finalres;
    }

    public function topot($berat, $item)
    {
        return $berat * $item / 100;
    }

    public function getNama($inv)
    {
        return Penerimaan::where('kode_penerimaan', $inv)->first();
    }

    /**
     * function tambah gabah kering
     * @return true or false
     */
    public function addKering(Request $req)
    {
        $penerimaan = Penerimaan::where('kode_penerimaan', $req->kode)->first();

        $insert = Kering::insert(['kode_penerimaan' => $req->kode, 'nama_gabah' => $penerimaan['nama_gabah'], 'tanggal' => $req->tgl, 'berat_kotor' => $penerimaan['berat_kotor'], 'total_potongan' => $penerimaan['total_potongan'], 'total_pot_zak' => $penerimaan['total_pot_zak'], 'total_berat' => $penerimaan['total_berat'], 'total_bayar' => $penerimaan['total_bayar'], 'tgl_data' => now()]);

        return $insert == true ? response()->json(['pesan' => 'sukses']) : response()->json(['pesan' => 'gagal']);
    }

    /**
     * function tambah giling gabah
     * @return JSON
     * @param Request $req
     */
    public function addGiling(Request $req)
    {
        $penerimaan = Kering::where('kode_penerimaan', $req->kode)->first();

        return Giling::insert(['kode_penerimaan' => $req->kode, 'nama_gabah' => $penerimaan['nama_gabah'], 'tanggal' => $req->tgl, 'berat_kotor' => $penerimaan['berat_kotor'], 'total_potongan' => $penerimaan['total_potongan'], 'total_pot_zak' => $penerimaan['total_pot_zak'], 'total_berat' => $req->berat, 'total_bayar' => $penerimaan['total_bayar'], 'tgl_data' => now()]) ? response()->json(['pesan' => 'sukses']) : response()->json(['pesan' => 'gagal']);
    }

    public function uDetail(Request $req)
    {
        return Detail::where('id_detail_penerimaan', $req->kode)->update([
            'potongan' => $req->pot
        ]) ? response()->json(['pesan' => 'sukses']) : response()->json(['pesan' => 'gagal']);
    }

    public function getSelect()
    {
        return response()->json(['pesan' => 'sukses', 'data' => Penerimaan::orderBy('id_penerimaan', 'desc')->get()]);
    }

    public function getGil()
    {
        return response()->json(['pesan' => 'sukses', 'data' => Giling::orderBy('id_giling_gabah', 'desc')->get()]);
    }

    public function listChart($kode)
    {
        $last = [];
        $groub = Detail::select('potongan')->where('kode_penerimaan', $kode)->groupBy('potongan')->get();
        foreach ($groub as $item) {
            $list = DB::select("SELECT * FROM tb_detail_penerimaan WHERE kode_penerimaan = '{$kode}' AND potongan = '{$item['potongan']}'");
            $last[] = $list;
        }
        return $last;
    }

    public function Middle($kode)
    {
        $list = $this->listChart($kode);
        $array = array();

        for ($i = 0; $i < count($list); $i++) {
            $array[] = $this->setuparray(count($list[$i]), $list[$i]);
        }

        return $array;
    }

    public function setuparray($count, $data)
    {
        $arr = [];
        $berat = [];
        $no = 0;

        foreach ($data as $item) {
            array_push($arr, $no);
            array_push($berat, $item->berat);
            $arr[$no] = ['berat' => $berat, 'diskon' => $item->potongan];
            $no++;
        }

        return $arr;
    }

    public function midsetup($count, array $arr)
    {
        $lc = [];
        $la = [];

        for ($i = 0; $i < $count; $i++) {
            $lc[] = count($arr[$i]);
        }

        for ($i = 0; $i < $count; $i++) {
            $la[] = $lc[$i] - 1;
        }

        return $la;
    }
}
