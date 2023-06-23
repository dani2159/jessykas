<?php

namespace App\Http\Controllers;


use App\Models\Penerimaan;
use App\Models\Pengeluaran;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Highcharts;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //total penerimaan
        $data['total_penerimaan'] = Penerimaan::sum('jumlah_penerimaan');
        //total pengeluaran
        $data['total_pengeluaran'] = Pengeluaran::sum('jumlah_pengeluaran');
        //total saldo
        $data['total_saldo'] = $data['total_penerimaan'] - $data['total_pengeluaran'];
        //total penerimaan perbulan
        $data['penerimaan_perbulan'] = Penerimaan::select(DB::raw('MONTH(tanggal_penerimaan) as bulan'), DB::raw('SUM(jumlah_penerimaan) as total'))
            ->groupBy(DB::raw('MONTH(tanggal_penerimaan)'))
            ->get();
        //total pengeluaran perbulan
        $data['pengeluaran_perbulan'] = Pengeluaran::select(DB::raw('MONTH(tanggal_pengeluaran) as bulan'), DB::raw('SUM(jumlah_pengeluaran) as total'))
            ->groupBy(DB::raw('MONTH(tanggal_pengeluaran)'))
            ->get();
        //total penerimaan pertahun
        $data['penerimaan_pertahun'] = Penerimaan::select(DB::raw('YEAR(tanggal_penerimaan) as tahun'), DB::raw('SUM(jumlah_penerimaan) as total'))
            ->groupBy(DB::raw('YEAR(tanggal_penerimaan)'))
            ->get();
        //total pengeluaran pertahun
        $data['pengeluaran_pertahun'] = Pengeluaran::select(DB::raw('YEAR(tanggal_pengeluaran) as tahun'), DB::raw('SUM(jumlah_pengeluaran) as total'))
            ->groupBy(DB::raw('YEAR(tanggal_pengeluaran)'))
            ->get();
        //data pengguna
        $data['total_pengguna'] = DB::table('tb_users')->count();


        return view('admin.dashboard.index', $data);
    }


}
