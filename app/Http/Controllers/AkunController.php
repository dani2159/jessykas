<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Akun;

class AkunController extends Controller
{
    public function index()
    {
        $data['list'] = Akun::all();

        return view('admin.dataakun.index', $data);

    }

    public function store(Request $request)
    {
        $data = new akun;
        $data->kode_akun = $request->kode_akun;
        $data->nama_akun = $request->nama_akun;
        $data->kelompok_akun = $request->kelompok_akun;

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
        $data = Akun::find($request->id);
        if($data){
            $data->kode_akun = $request->kode_akun;
            $data->nama_akun = $request->nama_akun;
            $data->kelompok_akun = $request->kelompok_akun;
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
        $data = Akun::find($request->id);

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
