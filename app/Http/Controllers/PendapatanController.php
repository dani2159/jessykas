<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pendapatan;

class PendapatanController extends Controller
{
    public function index()
    {
        $data['list'] = Pendapatan::all();

        return view('admin.pendapatan.index', $data);

    }

    public function store(Request $request)
    {
        $data = new Pendapatan;
        $data->kode_pendapatan = $request->kode_pendapatan;
        $data->nama_pendapatan = $request->nama_pendapatan;
        $data->keterangan = $request->keterangan;

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
        $data = Pendapatan::find($request->id);
        if($data){
            $data->kode_pendapatan = $request->kode_pendapatan;
            $data->nama_pendapatan = $request->nama_pendapatan;
            $data->keterangan = $request->keterangan;
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
        $data = Pendapatan::find($request->id);

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
