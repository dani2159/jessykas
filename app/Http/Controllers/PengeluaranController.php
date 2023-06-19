<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pengeluaran;
use Carbon\Carbon;

class PengeluaranController extends Controller
{
    public function index()
    {
        $latest = Pengeluaran::latest()->first();
        $no = 1;

        if($latest){
            $no = intval(substr($latest->no_expenditure, 1, 3)) + 1;
        }

        $currentDate = Carbon::now();
        $romanMonth = $currentDate->format('n');
        $romanNumerals = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $formattedMonth = $romanNumerals[$romanMonth - 1];
        $formattedYear = $currentDate->format('Y');

        $data['no_expenditure'] = 'E' . str_pad($no, 3, '0', STR_PAD_LEFT) . '/' . $formattedMonth . '/' . $formattedYear;


        $data['list'] = Pengeluaran::all();
        return view('admin.pengeluaran.index', $data);

    }

    public function store(Request $request)
    {
        $data = new pengeluaran;
        $data->no_expenditure = $request->no_expenditure;
        $data->tanggal_pengeluaran = $request->tanggal;
        $data->keterangan = $request->keterangan;
        $data->jumlah_pengeluaran = $request->jumlah_pengeluaran;

        if($data->save()){
            $result['status'] = true;
            $result['message'] = 'Data berhasil disimpan.';
        } else {
            $result['status'] = false;
            $result['message'] = 'Data gagal disimpan.';
        }

        return $result;
    }

    public function update(Request $request)
    {
        $data = Pengeluaran::find($request->id);
        if($data){
            $data->tanggal_pengeluaran = $request->tanggal;
            $data->keterangan = $request->keterangan;
            $data->jumlah_pengeluaran = $request->jumlah_pengeluaran;
            if($data->save()){
                $result['status'] = true;
                $result['message'] = 'Data berhasil diubah.';
            } else {
                $result['status'] = false;
                $result['message'] = 'Data gagal diubah.';
            }
        } else {
            $result['status'] = false;
            $result['message'] = 'Data tidak ditemukan.';
        }

        return $result;
    }

    public function destroy(Request $request)
    {
        $data = Pengeluaran::find($request->id);

        if($data->delete()){
            $result['status'] = true;
            $result['message'] = 'Data berhasil dihapus.';
        } else {
            $result['status'] = false;
            $result['message'] = 'Data gagal dihapus.';
        }

        return $result;
    }

}
