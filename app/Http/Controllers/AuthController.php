<?php

namespace App\Http\Controllers;

use App\Models\DataIbuModel;
use App\Models\UserModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SNMP;

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::check()) {
            if(Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif(Auth::user()->role == 'owner') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('login');
            }
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $checkAccount = UserModel::where(['username' => $request->username])->first();

        if ($checkAccount) {
            if ($checkAccount->status == 1) {
                Auth::attempt(['username' => $request->username, 'password' => $request->password]);
                if (Auth::check()) {
                    return response()->json([
                        'role' => Auth::user()->role,
                        'status' => true
                    ], 200);
                } else {
                    $result['status'] = false;
                    $result['message'] = "Username atau Password Salah.";
                }
            } else {
                $result['status'] = false;
                $result['message'] = 'Akun Anda tidak aktif, harap hubungi admin.';
            }
        } else {
            $result['status'] = false;
            $result['message'] = 'Data user tidak ditemukan.';
        }

        return $result;
    }

    public function logout()
    {
        if (Auth::check()) {
            session()->flush();
            Auth::logout();
        }

        return true;
    }

}
