<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Penerimaan;
use Carbon\Carbon;

class PenerimaanController extends Controller
{
    public function index()
    {

        $latest = Penerimaan::latest()->first();
        $no = 1;

        if($latest){
            $no = intval(substr($latest->no_income, 1, 3)) + 1;
        }

        $currentDate = Carbon::now();
        $romanMonth = $currentDate->format('n');
        $romanNumerals = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X', 'XI', 'XII'];
        $formattedMonth = $romanNumerals[$romanMonth - 1];
        $formattedYear = $currentDate->format('Y');

        $data['no_income'] = 'I' . str_pad($no, 3, '0', STR_PAD_LEFT) . '/' . $formattedMonth . '/' . $formattedYear;


        $data['list'] = Penerimaan::all();
        return view('admin.penerimaan.index', $data);

    }

    public function store(Request $request)
    {
        $data = new Penerimaan;
        $data->no_income = $request->no_income;
        $data->tanggal_penerimaan = $request->tanggal;
        $data->keterangan = $request->keterangan;
        $data->jumlah_penerimaan = $request->jumlah_penerimaan;

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
        $data = Penerimaan::find($request->id);
        if($data){
            $data->no_income = $request->no_income;
            $data->tanggal_penerimaan = $request->tanggal;
            $data->keterangan = $request->keterangan;
            $data->jumlah_penerimaan = $request->jumlah_penerimaan;
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
        $data = Penerimaan::find($request->id);

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
