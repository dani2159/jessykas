<?php

namespace App\Http\Controllers;


use App\Models\DataIbuModel;
use App\Models\DataPetugasModel;
use App\Models\DataBidanModel;
use App\Models\DataAnakModel;


use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Highcharts;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admin.dashboard.index');
    }


}
