<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barangs;

class BarangApiController extends Controller
{
    public function getKode($id){
        $kode_barang = Barangs::find($id);
        if (!$kode_barang) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json($kode_barang);
    }
}
