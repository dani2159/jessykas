<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Beban;

class BebanController extends Controller
{
    public function index()
    {
        $data['list'] = Beban::all();

        return view('admin.databeban.index', $data);

    }

    public function store(Request $request)
    {
        $data = new Beban;
        $data->kode_beban = $request->kode_beban;
        $data->nama_beban = $request->nama_beban;
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
        $data = Beban::find($request->id);
        if($data){
            $data->kode_beban = $request->kode_beban;
            $data->nama_beban = $request->nama;
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
        $data = Beban::find($request->id);

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
