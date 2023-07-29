<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PenerimaanBarang extends Model
{
    use HasFactory;
    protected $table = 'penerimaan_barang';

    public static function getPenerimaan()
    {
        $results = DB::table('barangs')
        ->join('penerimaan_barang', 'barangs.id', '=', 'penerimaan_barang.barang_id')
        ->select('barangs.nama_barang', 'penerimaan_barang.*')
        ->get();
        return $results;
    }

    public static function getPenerimaanPDF($startDate,$endDate){  
        $results = DB::table('barangs')
        ->join('penerimaan_barang', 'barangs.id', '=', 'penerimaan_barang.barang_id')
        ->whereBetween('penerimaan_barang.tanggal_penerimaan', [$startDate, $endDate])
        ->select('barangs.nama_barang', 'penerimaan_barang.*')
        ->get();
        return $results;
    }

    protected $fillable = [
        'id',
        'barang_id',
        'no_penerimaan',
        'kode_barang',
        'tanggal_penerimaan',
        'jumlah',
        'created_at',
        'updated_at',
    ];
}
