<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PengeluaranBarang extends Model
{
    use HasFactory;
    protected $table = 'pengeluaran_barang';

    public static function getPengeluaran()
    {
        $results = DB::table('barangs')
        ->join('pengeluaran_barang', 'barangs.id', '=', 'pengeluaran_barang.barang_id')
        ->select('barangs.nama_barang', 'pengeluaran_barang.*')->orderBy('tanggal_pengeluaran', 'DESC')
        ->get();
        return $results;        
    }

    public static function getPengeluaranPDF($startDate,$endDate){  
        // $results = DB::table('barangs')
        // ->join('pengeluaran_barang', 'barangs.id', '=', 'pengeluaran_barang.barang_id')
        // ->whereBetween('pengeluaran_barang.tanggal_pengeluaran', [$startDate, $endDate])
        // ->select('barangs.nama_barang', 'pengeluaran_barang.*')
        // ->get();
        // return $results;

        $results = DB::table('barangs')
        ->join('pengeluaran_barang', 'barangs.id', '=', 'pengeluaran_barang.barang_id')
        ->whereBetween('pengeluaran_barang.tanggal_pengeluaran', [$startDate, $endDate])
        ->select('barangs.nama_barang', 'pengeluaran_barang.*')->orderBy('tanggal_pengeluaran', 'DESC')
        ->get();
        return $results;
    }

    protected $fillable = [
        'id',
        'barang_id',
        'no_pengeluaran',
        'kode_barang',
        'tanggal_pengeluaran',
        'jumlah',
        'created_at',
        'updated_at',
    ];
}
