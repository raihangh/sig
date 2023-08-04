<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Barangs;
use App\Models\PenerimaanBarang;
use App\Models\PengeluaranBarang;
use Carbon\Carbon;
use Dompdf\Dompdf;

class DashboardController extends Controller
{
    private $barang;
    public function __construct()
    {
        $this->barang = new Barangs();
    }
    public function index(){
        $data = $this->barang->all();
        return view('pages/index', ['barang' => $data]);
    }
    public function dashboard()
    {
        $data = $this->barang->all();
        $penerimaan = count(PenerimaanBarang::getPenerimaan());
        $pengeluaran = count(PengeluaranBarang::getPengeluaran());
        $title = 'Dashboard';
        $barangStokKosong = $this->barang->where('stock', 0)->get();
        return view('pages/dashboard', ['barang' => $data,'penerimaan'=> $penerimaan,'pengeluaran'=> $pengeluaran, 'title' => $title, 'barangStokKosong' => $barangStokKosong]);
    }
    public function cetaktotalPDF()
    {
        $data = $this->barang->all();
        $pdf = new Dompdf(); // instantiate and use the dompdf class
        $pdf->loadHtml(view('pages.laporan_index', ['barang' => $data])->render());
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream('totalstok.pdf', [
            'compress' => true,
            'Attachment' => true,
        ]);
        exit();
    }
    
    public function penerimaan_barang()
    {
        $title = 'Penerimaan Barang';
        $data = $this->barang->all();
        $penerimaan = PenerimaanBarang::getPenerimaan();
        foreach ($penerimaan as $terima){
            $terima->tanggal_penerimaan = Carbon::parse($terima->tanggal_penerimaan)->format('d/m/Y');
        }
        return view('pages/penerimaan/penerimaan_barang', ['title' => $title, 'barang' => $data, 'penerimaan' => $penerimaan]);
    }
    public function pengeluaran_barang()
    {
        $title = 'Pengeluaran Barang';
        $data = $this->barang->all();
        $pengeluaran = PengeluaranBarang::getPengeluaran();
        foreach ($pengeluaran as $keluar){
            $keluar->tanggal_pengeluaran = Carbon::parse($keluar->tanggal_pengeluaran)->format('d/m/Y');
        }
        return view('pages/pengeluaran/pengeluaran_barang', ['title' => $title, 'barang' => $data, 'pengeluaran' => $pengeluaran]);
    }

    
    public function barang()
    {
        $data = $this->barang->all();
        $title = 'Barang';
        return view('pages/barang/dashboard_barangs', ['title' => $title, 'barang' => $data]);
    }
    

    public function pageInputBarang()
    {
        $title = 'Input Barang';
        return view('pages/barang/dashboard_input_barang', ['title' => $title]);
    }

    public function pageLaporan()
    {
        $title = 'Laporan';
        $penerimaan = PenerimaanBarang::getPenerimaan();
        foreach ($penerimaan as $terima){
            $terima->tanggal_penerimaan = Carbon::parse($terima->tanggal_penerimaan)->format('d-m-Y');
        }
        $pengeluaran = PengeluaranBarang::getPengeluaran();
        foreach ($pengeluaran as $keluar){
            $keluar->tanggal_pengeluaran = Carbon::parse($keluar->tanggal_pengeluaran)->format('d-m-Y');
        }
        $startDatePenerimaan ='';
        $endDatePenerimaan='';
        $startDatePengeluaran ='';
        $endDatePengeluaran='';
        return view('pages/dashboard_laporan', [
            'title' => $title,
            'penerimaan'=> $penerimaan, 
            'pengeluaran'=> $pengeluaran,
            'startDatePenerimaan'=> $startDatePenerimaan,
            'endDatePenerimaan'=> $endDatePenerimaan,
            'startDatePengeluaran'=> $startDatePengeluaran,
            'endDatePengeluaran'=> $endDatePengeluaran,
        ]);
    }

    public function penerimaanSearch(Request $request)
    {
        $title = 'Laporan';
        $request->validate([
            'tanggal_penerimaan' => 'required',
            'tanggal_penerimaan_end' => 'required',
        ]);

        $startDate = $request->input('tanggal_penerimaan');
        $endDate = $request->input('tanggal_penerimaan_end');

        $penerimaan = PenerimaanBarang::getPenerimaanPDF($startDate,$endDate);
        foreach ($penerimaan as $terima){
            $terima->tanggal_penerimaan = Carbon::parse($terima->tanggal_penerimaan)->format('d-m-Y');
        }
        $pengeluaran = PengeluaranBarang::getPengeluaran();
        foreach ($pengeluaran as $keluar){
            $keluar->tanggal_pengeluaran = Carbon::parse($keluar->tanggal_pengeluaran)->format('d-m-Y');
        }

        $startDatePenerimaan = Carbon::parse($startDate)->format('d-m-Y');
        $endDatePenerimaan = Carbon::parse($endDate)->format('d-m-Y');
        $startDatePengeluaran ='';
        $endDatePengeluaran='';
        return view('pages/dashboard_laporan', [
            'title' => $title,
            'penerimaan'=> $penerimaan, 
            'pengeluaran'=> $pengeluaran,
            'startDatePenerimaan'=> $startDatePenerimaan,
            'endDatePenerimaan'=> $endDatePenerimaan,
            'startDatePengeluaran'=> $startDatePengeluaran,
            'endDatePengeluaran'=> $endDatePengeluaran,
        ]);
    }

    public function pengeluaranSearch(Request $request)
    {
        $title = 'Laporan';
        $request->validate([
            'tanggal_pengeluaran' => 'required',
            'tanggal_pengeluaran_end' => 'required',
        ]);

        $startDate = $request->input('tanggal_pengeluaran');
        $endDate = $request->input('tanggal_pengeluaran_end');

        $penerimaan = PenerimaanBarang::getPenerimaan();
        foreach ($penerimaan as $terima){
            $terima->tanggal_penerimaan = Carbon::parse($terima->tanggal_penerimaan)->format('d-m-Y');
        }
        $pengeluaran = PengeluaranBarang::getPengeluaranPDF($startDate,$endDate);
        foreach ($pengeluaran as $keluar){
            $keluar->tanggal_pengeluaran = Carbon::parse($keluar->tanggal_pengeluaran)->format('d-m-Y');
        }

        $startDatePenerimaan = '';
        $endDatePenerimaan = '';
        $startDatePengeluaran = Carbon::parse($startDate)->format('d-m-Y');
        $endDatePengeluaran= Carbon::parse($endDate)->format('d-m-Y');
        return view('pages/dashboard_laporan', [
            'title' => $title,
            'penerimaan'=> $penerimaan, 
            'pengeluaran'=> $pengeluaran,
            'startDatePenerimaan'=> $startDatePenerimaan,
            'endDatePenerimaan'=> $endDatePenerimaan,
            'startDatePengeluaran'=> $startDatePengeluaran,
            'endDatePengeluaran'=> $endDatePengeluaran,
        ]);
    }

    public function cetakPDFpenerimaan($startDate, $endDate)
    {
        $startDate =Carbon::parse($startDate)->format('Y/m/d');
        $endDate =Carbon::parse($endDate)->format('Y/m/d');
        
        $penerimaanBarangs = PenerimaanBarang::getPenerimaanPDF($startDate, $endDate); 
        $pdf = new Dompdf();
        foreach ($penerimaanBarangs as $terima){
            $terima->tanggal_penerimaan = Carbon::parse($terima->tanggal_penerimaan)->format('d-m-Y');
        }

        $startDate = Carbon::parse($startDate)->format('d-m-Y');
        $endDate = Carbon::parse($endDate)->format('d-m-Y');

        $pdf->loadHtml(view('pages.laporan_penerimaan_barang', ['penerimaanBarangs' => $penerimaanBarangs,'startedDate'=> $startDate,'endDate'=> $endDate])->render()); // Replace with your actual view name
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream('penerimaanbarang.pdf', [
            'compress' => true,
            'Attachment' => true,
        ]);
        exit();
    }

    public function cetakPDFpengeluaran($startDate, $endDate)
    {
        $startDate =Carbon::parse($startDate)->format('Y/m/d');
        $endDate =Carbon::parse($endDate)->format('Y/m/d');

        $pengeluaranBarangs = PengeluaranBarang::getPengeluaranPDF($startDate, $endDate); 
        foreach ($pengeluaranBarangs as $keluar){
            $keluar->tanggal_pengeluaran = Carbon::parse($keluar->tanggal_pengeluaran)->format('d-m-Y');
        }
        $pdf = new Dompdf();  
        
        $startDate = Carbon::parse($startDate)->format('d-m-Y');
        $endDate = Carbon::parse($endDate)->format('d-m-Y');

        $pdf->loadHtml(view('pages.laporan_pengeluaran_barang', ['pengeluaranBarangs' => $pengeluaranBarangs,'startedDate'=> $startDate,'endDate'=> $endDate])->render()); // Replace with your actual view name
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $pdf->stream('pengeluaranbarang.pdf', [
            'compress' => true,
            'Attachment' => true,
        ]);
        exit();
    }

    public function logout()
    {
        Auth::logout();
        // Redirect ke halaman login
        return redirect('/login');
    }
}
