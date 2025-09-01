<?php

namespace App\Http\Controllers;

use App\Models\Peta;
use App\Models\PetaBelum;
use App\Models\PetaSesuai;
use App\Models\UploadPeta;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        return view('home.index', [
            'title' => 'Home',
            'jml_data_scan' => Peta::where('void', 0)->get()->count(),
            'jml_data_sesuai' => PetaSesuai::where('void', 0)->get()->count(),
            'jml_data_tidak' => PetaBelum::where('void', 0)->get()->count(),
        ]);
    }
}
