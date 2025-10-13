<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        return view('petugas.index', [
            'title' => 'Petugas',
        ]);
    }

    public function getDataPetugas()
    {
        $petugas = Petugas::all();
        return datatables()->of($petugas)
            ->addColumn('action', function ($data) {
                $button = '<a href="javascript:void(0)"  data-id="' . $data->id . '" class="edit_petugas btn btn-info btn-xs edit-post" data-toggle="modal" data-target="#modal-edit-petugas" ><i class="fas fa-edit"></i> Edit</a>';
                $button .= '&nbsp;&nbsp;';
                return $button;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    public function addPetugas(Request $request)
    {
        $dt_cek = Petugas::where('nm_petugas', '=', $request->nm_petugas)->first();
        if ($dt_cek) {
            return false;
        } else {
            Petugas::create([
                'nm_petugas' => $request->nm_petugas
            ]);
            return true;
        }
    }

    public function getPetugas($id)
    {
        $data  = Petugas::where('id', $id)->first();
        return response()->json($data);
    }

    public function editPetugas(Request $request)
    {
        $edit = Petugas::where('id', $request->id)->update([
            'nm_petugas' => $request->nm_petugas
        ]);
        return response()->json($edit);
    }
}
