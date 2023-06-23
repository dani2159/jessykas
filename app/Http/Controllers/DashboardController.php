<?php

namespace App\Http\Controllers;



use App\Models\Transaksi;


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
        $data['total_penerimaan'] = Transaksi::whereNotNull('penerimaan')->sum('penerimaan');
        //total pengeluaran
        $data['total_pengeluaran'] = Transaksi::whereNotNull('pengeluaran')->sum('pengeluaran');
        //total saldo
        $data['total_saldo'] = $data['total_penerimaan'] - $data['total_pengeluaran'];
        //total penerimaan perbulan
        $data['penerimaan_perbulan'] = 0;
        //total pengeluaran perbulan
        $data['pengeluaran_perbulan'] = 0;
        //total penerimaan pertahun
        $data['penerimaan_pertahun'] = 0;
        //total pengeluaran pertahun
        $data['pengeluaran_pertahun'] = 0;
        //data pengguna
        $data['total_pengguna'] = DB::table('tb_users')->count();


        return view('admin.dashboard.index', $data);
    }


}
