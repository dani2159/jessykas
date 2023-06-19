<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerimaan;
use App\Models\Pengeluaran;

use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function LaporanPenerimaan()
    {
        return view('admin.penerimaan.laporan');
    }

    public function LaporanPenerimaanList(Request $request)
    {
        $fromDate = date('Y-m-d', strtotime($request->input('from_date')));
        $toDate =  date('Y-m-d', strtotime($request->input('to_date')));

        if ($request->ajax()) {
            $data = Penerimaan::where('tanggal_penerimaan', '>=', $fromDate)
                ->where('tanggal_penerimaan', '<=', $toDate)
                ->orderBy('tanggal_penerimaan', 'asc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tanggal_penerimaan', function ($data) {
                    Carbon::setLocale('id');
                    return Carbon::parse($data->tanggal_penerimaan)->translatedFormat('d F Y');

                })
                ->editColumn('jumlah_penerimaan', function ($data) {
                    return 'Rp. ' . number_format($data->jumlah_penerimaan, 0, ',', '.');
                })
                ->rawColumns(['tanggal_penerimaan', 'jumlah_penerimaan'])
                ->make(true);
        }
    }

    public function LaporanPengeluaran()
    {
        return view('admin.pengeluaran.laporan');
    }

    public function LaporanPengeluaranList(Request $request)
    {
        $fromDate = date('Y-m-d', strtotime($request->input('from_date')));
        $toDate =  date('Y-m-d', strtotime($request->input('to_date')));

        if ($request->ajax()) {
            $data = Pengeluaran::where('tanggal_pengeluaran', '>=', $fromDate)
                ->where('tanggal_pengeluaran', '<=', $toDate)
                ->orderBy('tanggal_pengeluaran', 'asc')
                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('tanggal_pengeluaran', function ($data) {
                    Carbon::setLocale('id');
                    return Carbon::parse($data->tanggal_pengeluaran)->translatedFormat('d F Y');

                })
                ->editColumn('jumlah_pengeluaran', function ($data) {
                    return 'Rp. ' . number_format($data->jumlah_pengeluaran, 0, ',', '.');
                })
                ->rawColumns(['tanggal_pengeluaran', 'jumlah_pengeluaran'])
                ->make(true);
        }
    }
}
