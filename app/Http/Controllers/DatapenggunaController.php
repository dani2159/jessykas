<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;

class DatapenggunaController extends Controller
{
    public function index()
    {
        $data['list'] =  UserModel::all();
        return view('admin.datapengguna.index', $data);
    }

    public function store(Request $request)
    {
        $check = UserModel::where(['username' => $request->username])->first();

        if (!$check) {
            $data = new UserModel;
            $data->username = $request->username;
            $data->password = bcrypt($request->password);
            $data->role = $request->role;
            $data->status = $request->status;
            $data->nama = $request->nama;

            if ($data->save()) {
                $result['status'] = true;
                $result['message'] = 'Data berhasil disimpan.';
            } else {
                $result['status'] = false;
                $result['message'] = 'Data gagal disimpan.';
            }
        } else {
            $result['status'] = false;
            $result['message'] = 'Username sudah digunakan.';
        }

        return $result;
    }

    public function destroy(Request $request)
    {
        $check = UserModel::where(['id' => $request->id])->first();

        if ($check) {
            if ($check->delete()) {
                $result['status'] = true;
                $result['message'] = 'Data berhasil dihapus.';
            } else {
                $result['status'] = false;
                $result['message'] = 'Data gagal dihapus.';
            }
        } else {
            $result['status'] = false;
            $result['message'] = 'Data tidak ditemukan.';
        }

        return $result;
    }

    public function update(Request $request)
    {
        $check = UserModel::where(['id' => $request->id])->first();

        if ($check) {
            $check->username = $request->username;
            $check->role = $request->role;
            $check->status = $request->status;
            $check->nama = $request->nama;

            if ($request->password) {
                $check->password = bcrypt($request->password);
            }

            if ($check->save()) {
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
}
