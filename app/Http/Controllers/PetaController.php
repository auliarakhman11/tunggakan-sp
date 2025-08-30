<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Peta;
use App\Models\UploadPeta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PetaController extends Controller
{
    public function index()
    {
        return view('peta.index', [
            'title' => 'List Peta',
            'kelurahan' => Kelurahan::all(),
            'kecamatan' => Kecamatan::all()
        ]);
    }

    public function findKelurahan($id)
    {
        $dt_kelurahan = Kelurahan::where('kecamatan_id', $id)->get();
        foreach ($dt_kelurahan as $d) {
            echo '<option value="' . $d->id . '|' . $d->nm_kelurahan . '">' . $d->nm_kelurahan . '</option>';
        }
    }

    public function addPeta(Request $request)
    {

        $peta = Peta::create([
            'nm_peta' => $request->nm_peta,
            'no_peta' => $request->no_peta,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'kelurahan_id' => $request->kelurahan_id,
            'kecamatan_id' => $request->kecamatan_id,
            'tahun_pembuatan' => $request->tahun_pembuatan,
            'jenis_kertas' => $request->jenis_kertas,
            'user_id' => Auth::id(),
            'void' => 0,
        ]);

        if ($request->hasFile('file_name1')) {
            $extension1 = $request->file('file_name1')->extension();
            $file_name1 = $peta->id . Str::random(2) . date('ymd') . '.' . $extension1;
            $request->file('file_name1')->move('scan-file/', $file_name1);

            UploadPeta::create([
                'peta_id' => $peta->id,
                'nm_uplaod' => $request->nm_uplaod1,
                'file_name' => $file_name1,
                'jenis_file' => $extension1
            ]);
        }

        if ($request->hasFile('file_name2')) {
            $extension2 = $request->file('file_name2')->extension();
            $file_name2 = $peta->id . Str::random(2) . date('ymd') . '.' . $extension2;
            $request->file('file_name2')->move('scan-file/', $file_name2);

            UploadPeta::create([
                'peta_id' => $peta->id,
                'nm_uplaod' => $request->nm_uplaod2,
                'file_name' => $file_name2,
                'jenis_file' => $extension2
            ]);
        }

        if ($request->hasFile('file_name3')) {
            $extension3 = $request->file('file_name3')->extension();
            $file_name3 = $peta->id . Str::random(2) . date('ymd') . '.' . $extension3;
            $request->file('file_name3')->move('scan-file/', $file_name3);

            UploadPeta::create([
                'peta_id' => $peta->id,
                'nm_uplaod' => $request->nm_uplaod3,
                'file_name' => $file_name3,
                'jenis_file' => $extension3
            ]);
        }

        return true;
    }

    public function getDataPeta()
    {
        $peta = Peta::query()->where('void', 0)->orderBy('id', 'DESC')->with(['kecamatan', 'kelurahan', 'user']);

        return datatables()->of($peta)
            ->addColumn('btn_upload', function ($data) {
                return '<a data-target="#modal_uplaod" href="javascript:void(0)" class="btn btn-xs btn-success btn_upload" data-toggle="modal" peta_id="' . $data->id . '"><i class="fas fa-upload"></i> Uplaod</a> <a href="javascript:void(0)" data-target="#modal_download" class="btn btn-xs btn-primary btn_download" data-toggle="modal" peta_id="' . $data->id . '"><i class="fas fa-download"></i> Download</a>';
            })
            ->addColumn('aksi', function ($data) {
                return '<a href="javascript:void(0)" data-target="#modal_edit_peta" class="btn btn-xs btn-primary btn_edit_peta" data-toggle="modal" peta_id="' . $data->id . '"><i class="fas fa-edit"></i></a> <a href="javascript:void(0)" class="btn btn-xs btn-danger btn_delete_peta" peta_id="' . $data->id . '"><i class="fas fa-trash"></i></a>';
            })

            ->rawColumns(['btn_upload', 'aksi'])
            ->addIndexColumn()
            ->make(true);
    }

    public function downloadDataPeta($peta_id)
    {
        return view('peta.downloadPeta', [
            'peta' => Peta::where('id', $peta_id)->with('uploadPeta')->first(),
        ])->render();
    }

    public function downloadFilePeta($file_name)
    {
        return response()->download(public_path('scan-file/' . $file_name));
    }

    public function geteditPeta($peta_id)
    {
        return view('peta.editPeta', [
            'peta' => Peta::where('id', $peta_id)->first(),
            'kelurahan' => Kelurahan::all(),
            'kecamatan' => Kecamatan::all(),
        ])->render();
    }

    public function editPeta(Request $request)
    {
        Peta::where('id', $request->id)->update([
            'nm_peta' => $request->nm_peta,
            'no_peta' => $request->no_peta,
            'jenis_kegiatan' => $request->jenis_kegiatan,
            'kelurahan_id' => $request->kelurahan_id,
            'kecamatan_id' => $request->kecamatan_id,
            'tahun_pembuatan' => $request->tahun_pembuatan,
            'jenis_kertas' => $request->jenis_kertas,
            'user_id' => Auth::id(),
        ]);

        return true;
    }

    public function deletePeta($peta_id)
    {
        Peta::where('id', $peta_id)->update([
            'void' => 1,
            'user_id' => Auth::id(),
        ]);

        $dt_uplaod = UploadPeta::where('peta_id', $peta_id)->get();

        foreach ($dt_uplaod as $d) {
            File::delete('scan-file/' . $d->file_name);
        }

        return true;
    }

    public function uploadPeta(Request $request)
    {
        if ($request->hasFile('file_name1')) {
            $extension1 = $request->file('file_name1')->extension();
            $file_name1 = $request->id . Str::random(2) . date('ymd') . '.' . $extension1;
            $request->file('file_name1')->move('scan-file/', $file_name1);

            UploadPeta::create([
                'peta_id' => $request->id,
                'nm_uplaod' => $request->nm_uplaod1,
                'file_name' => $file_name1,
                'jenis_file' => $extension1
            ]);
        }

        if ($request->hasFile('file_name2')) {
            $extension2 = $request->file('file_name2')->extension();
            $file_name2 = $request->id . Str::random(2) . date('ymd') . '.' . $extension2;
            $request->file('file_name2')->move('scan-file/', $file_name2);

            UploadPeta::create([
                'peta_id' => $request->id,
                'nm_uplaod' => $request->nm_uplaod2,
                'file_name' => $file_name2,
                'jenis_file' => $extension2
            ]);
        }

        if ($request->hasFile('file_name3')) {
            $extension3 = $request->file('file_name3')->extension();
            $file_name3 = $request->id . Str::random(2) . date('ymd') . '.' . $extension3;
            $request->file('file_name3')->move('scan-file/', $file_name3);

            UploadPeta::create([
                'peta_id' => $request->id,
                'nm_uplaod' => $request->nm_uplaod3,
                'file_name' => $file_name3,
                'jenis_file' => $extension3
            ]);
        }

        return true;
    }
}
