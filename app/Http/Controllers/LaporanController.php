<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Pengeluaran;

use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function LaporanList(Request $request)
{
    $fromDate = date('Y-m-d', strtotime($request->input('from_date')));
    $toDate =  date('Y-m-d', strtotime($request->input('to_date')));

    if ($request->ajax()) {
        // Check pilihan penerimaan atau pengeluaran atau keduanya. Jika ya, tampilkan data sesuai pilihan. Jika tidak, tampilkan semua data transaksi berdasarkan tanggal.
        if ($request->filter_data == 'penerimaan') {
            $data = Transaksi::where('tanggal', '>=', $fromDate)
                ->where('tanggal', '<=', $toDate)
                ->whereNotNull('penerimaan')
                ->orderBy('tanggal', 'asc')
                ->get();
        } elseif ($request->filter_data == 'pengeluaran') {
            $data = Transaksi::where('tanggal', '>=', $fromDate)
                ->where('tanggal', '<=', $toDate)
                ->whereNotNull('pengeluaran')
                ->orderBy('tanggal', 'asc')
                ->get();
        } else {
            $data = Transaksi::where('tanggal', '>=', $fromDate)
                ->where('tanggal', '<=', $toDate)
                ->orderBy('tanggal', 'asc')
                ->get();
        }

        $saldo = 0; // Inisialisasi saldo awal

        $data->transform(function ($item) use (&$saldo) {
            // Hitung saldo dengan mengurangi penerimaan dan pengeluaran
            $item->saldo = $saldo + ($item->penerimaan ?? 0) - ($item->pengeluaran ?? 0);
            $saldo = $item->saldo; // Simpan saldo untuk iterasi berikutnya
            return $item;
        });

        return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($data) {
                Carbon::setLocale('id');
                return Carbon::parse($data->tanggal)->translatedFormat('d F Y');
            })
            ->editColumn('penerimaan', function ($data) {
                return $data->penerimaan == null ? '-' :  $data->penerimaan;
            })
            ->editColumn('pengeluaran', function ($data) {
                return $data->pengeluaran == null ? '-' :  $data->pengeluaran;
            })
            ->editColumn('saldo', function ($data) {
                $filterData = request()->input('filter_data');
                if($filterData == 'penerimaan') {
                    return '-';
                } elseif($filterData == 'pengeluaran') {
                    return '-';
                } else {
                    return $data->saldo;
                }
            })
            ->rawColumns(['tanggal', 'penerimaan', 'pengeluaran', 'saldo'])
            ->make(true);
    }
}


}
