<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use Illuminate\Http\Request;

class LimitController extends Controller
{
    public function getLimit()
    {
        $now = date('d');
        return count(Penerimaan::whereDay('tgl_data', $now)->get());
    }
    
    public function filterData(Request $req)
    {
        return response()->json(['data' => Penerimaan::whereBetween('tgl_data', [$req->tgl1, $req->tgl2])->get(), 'tgl2' => $req->tgl2, 'tgl1' => $req->tgl1]);
    }
}
