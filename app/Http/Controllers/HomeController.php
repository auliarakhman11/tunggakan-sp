<?php

namespace App\Http\Controllers;

use App\Models\UploadPeta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        return view('home.index', [
            'title' => 'Home',
            'jml_data_scan' => UploadPeta::where('sesuai_posisi', 0)->get()->count(),
            'jml_data_sesuai' => UploadPeta::where('sesuai_posisi', 1)->get()->count(),
            'jml_data_tidak' => UploadPeta::where('sesuai_posisi', 2)->get()->count(),
        ]);
    }
}
