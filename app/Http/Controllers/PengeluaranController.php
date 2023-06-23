<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Transaksi;
use App\Models\Akun;
use Carbon\Carbon;

class PengeluaranController extends Controller
{
    public function index()
    {

        $latest = Transaksi::latest()->first();
        $no = 1;

        if ($latest) {
            $no = intval(substr($latest->no_transaksi, 3)) + 1;
        }

        $data['no_transaksi'] = 'TRK' . str_pad($no, 6, '0', STR_PAD_LEFT);


        $data['list'] = Transaksi::join('tb_akun', 'tb_akun.kode_akun', '=', 'tb_transaksi.kode_akun')
        ->select('tb_transaksi.*', 'tb_akun.kode_akun', 'tb_akun.nama_akun')
        ->whereNotNull('tb_transaksi.pengeluaran')
        ->get();

        $data['akun'] = Akun::all();

        return view('admin.pengeluaran.index', $data);

    }

    public function store(Request $request)
    {
        $data = new Transaksi;
        $data->no_transaksi = $request->no_transaksi;
        $data->kode_akun = $request->kode_akun;
        $data->tanggal = $request->tanggal;
        $data->keterangan = $request->keterangan;
        $data->pengeluaran = $request->pengeluaran;
        $data->id_pengguna = Auth::user()->id;
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
        $data = Transaksi::find($request->id);
        if($data){
            $data->no_transaksi = $request->no_transaksi;
            $data->kode_akun = $request->kode_akun;
            $data->tanggal = $request->tanggal;
            $data->keterangan = $request->keterangan;
            $data->pengeluaran = $request->pengeluaran;
            $data->id_pengguna = Auth::user()->id;
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
        $data = Transaksi::find($request->id);

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
