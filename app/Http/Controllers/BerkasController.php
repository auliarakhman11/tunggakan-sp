<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\History;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
    public function index()
    {
        return view('catatan.index', [
            'title' => 'List Berkas',

        ]);
    }

    public function getBerkas()
    {
        $berkas = Berkas::query()->where('void', 0)->orderBy('id', 'DESC')->with(['user', 'proses']);

        return datatables()->of($berkas)
            ->addColumn('aksi', function ($data) {
                return '<a href="javascript:void(0)" data-target="#modal_edit_catatan" class="btn btn-xs btn-primary btn_edit_catatan" data-toggle="modal" catatan_id="' . $data->id . '"><i class="fas fa-edit"></i></a> <a href="javascript:void(0)" class="btn btn-xs btn-danger btn_delete_catatan" catatan_id="' . $data->id . '"><i class="fas fa-trash"></i></a>';
            })

            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->make(true);
    }

    public function addBerkas(Request $request)
    {

        $berkas = Berkas::create([
            'proses_id' => $request->proses_id,
            'no_berkas' => $request->no_berkas,
            'tahun' => $request->tahun,
            'kelurahan' => $request->kelurahan,
            'tgl' => $request->tgl,
            'user_id' => Auth::id(),
            'void' => 0,
        ]);

        History::create([
            'berkas_id' => $berkas->id,
            'proses_id' => $request->proses_id,
            'tgl' => $request->tgl,
            'user_id' => Auth::id(),
        ]);

        return true;
    }
}
