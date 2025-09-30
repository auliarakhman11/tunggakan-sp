<?php

namespace App\Http\Controllers;

use App\Models\Catatan;
use App\Models\UploadCatatan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class CatatanController extends Controller
{
    public function index()
    {
        return view('catatan.index', [
            'title' => 'List Catatan',

        ]);
    }


    public function getDataCatatan()
    {
        $catatan = Catatan::query()->where('void', 0)->orderBy('id', 'DESC')->with(['user']);

        return datatables()->of($catatan)
            ->addColumn('btn_upload', function ($data) {
                return '<a data-target="#modal_uplaod" href="javascript:void(0)" class="btn btn-xs btn-success btn_upload" data-toggle="modal" catatan_id="' . $data->id . '"><i class="fas fa-upload"></i> Uplaod</a> <a href="javascript:void(0)" data-target="#modal_download" class="btn btn-xs btn-primary btn_download" data-toggle="modal" catatan_id="' . $data->id . '"><i class="fas fa-download"></i> Download</a>';
            })
            ->addColumn('aksi', function ($data) {


                if (Auth::user()->role_id == 1) {
                    return '<a href="javascript:void(0)" data-target="#modal_edit_catatan" class="btn btn-xs btn-primary btn_edit_catatan" data-toggle="modal" catatan_id="' . $data->id . '"><i class="fas fa-edit"></i></a> <a href="javascript:void(0)" class="btn btn-xs btn-danger btn_delete_catatan" catatan_id="' . $data->id . '"><i class="fas fa-trash"></i></a>';
                } else {
                    return '';
                }
            })

            ->rawColumns(['btn_upload', 'aksi'])
            ->addIndexColumn()
            ->make(true);
    }

    public function addCatatan(Request $request)
    {

        $catatan = Catatan::create([
            'tgl' => $request->tgl,
            'isi_catatan' => $request->isi_catatan,
            'user_id' => Auth::id(),
            'void' => 0,
        ]);

        if ($request->hasFile('file_name1')) {
            $extension1 = $request->file('file_name1')->extension();
            $file_name1 = $catatan->id . Str::random(3) . date('ymd') . '.' . $extension1;
            $request->file('file_name1')->move('scan-file/', $file_name1);

            UploadCatatan::create([
                'catatan_id' => $catatan->id,
                'nm_uplaod' => $request->nm_uplaod1,
                'file_name' => $file_name1,
                'jenis_file' => $extension1
            ]);
        }

        if ($request->hasFile('file_name2')) {
            $extension2 = $request->file('file_name2')->extension();
            $file_name2 = $catatan->id . Str::random(3) . date('ymd') . '.' . $extension2;
            $request->file('file_name2')->move('scan-file/', $file_name2);

            UploadCatatan::create([
                'catatan_id' => $catatan->id,
                'nm_uplaod' => $request->nm_uplaod2,
                'file_name' => $file_name2,
                'jenis_file' => $extension2
            ]);
        }

        if ($request->hasFile('file_name3')) {
            $extension3 = $request->file('file_name3')->extension();
            $file_name3 = $catatan->id . Str::random(3) . date('ymd') . '.' . $extension3;
            $request->file('file_name3')->move('scan-file/', $file_name3);

            UploadCatatan::create([
                'catatan_id' => $catatan->id,
                'nm_uplaod' => $request->nm_uplaod3,
                'file_name' => $file_name3,
                'jenis_file' => $extension3
            ]);
        }

        return true;
    }

    public function downloadDataCatatan($catatan_id)
    {
        return view('catatan.downloadCatatan', [
            'catatan' => Catatan::where('id', $catatan_id)->with('uploadCatatanScan')->first(),
        ])->render();
    }

    public function downloadFileCatatan($file_name)
    {
        return response()->download(public_path('scan-file/' . $file_name));
    }

    public function deleteCatatan($catatan_id)
    {
        Catatan::where('id', $catatan_id)->update([
            'void' => 1,
            'user_id' => Auth::id(),
        ]);

        $dt_uplaod = UploadCatatan::where('catatan_id', $catatan_id)->get();

        foreach ($dt_uplaod as $d) {
            File::delete('scan-file/' . $d->file_name);
        }

        UploadCatatan::where('catatan_id', $catatan_id)->delete();

        return true;
    }

    public function deleteFileCatatan($id)
    {
        $dt_upload = UploadCatatan::where('id', $id)->first();
        UploadCatatan::where('id', $id)->delete();
        File::delete('scan-file/' . $dt_upload->file_name);

        return true;
    }

    public function uploadCatatan(Request $request)
    {
        if ($request->hasFile('file_name1')) {
            $extension1 = $request->file('file_name1')->extension();
            $file_name1 = $request->id . Str::random(3) . date('ymd') . '.' . $extension1;
            $request->file('file_name1')->move('scan-file/', $file_name1);

            UploadCatatan::create([
                'catatan_id' => $request->id,
                'nm_uplaod' => $request->nm_uplaod1,
                'file_name' => $file_name1,
                'jenis_file' => $extension1
            ]);
        }

        if ($request->hasFile('file_name2')) {
            $extension2 = $request->file('file_name2')->extension();
            $file_name2 = $request->id . Str::random(3) . date('ymd') . '.' . $extension2;
            $request->file('file_name2')->move('scan-file/', $file_name2);

            UploadCatatan::create([
                'catatan_id' => $request->id,
                'nm_uplaod' => $request->nm_uplaod2,
                'file_name' => $file_name2,
                'jenis_file' => $extension2
            ]);
        }

        if ($request->hasFile('file_name3')) {
            $extension3 = $request->file('file_name3')->extension();
            $file_name3 = $request->id . Str::random(3) . date('ymd') . '.' . $extension3;
            $request->file('file_name3')->move('scan-file/', $file_name3);

            UploadCatatan::create([
                'catatan_id' => $request->id,
                'nm_uplaod' => $request->nm_uplaod3,
                'file_name' => $file_name3,
                'jenis_file' => $extension3
            ]);
        }

        return true;
    }

    public function geteditCatatan($catatan_id)
    {
        return view('catatan.editCatatan', [
            'catatan' => Catatan::where('id', $catatan_id)->first(),
        ])->render();
    }

    public function editCatatan(Request $request)
    {
        Catatan::where('id', $request->id)->update([
            'tgl' => $request->tgl,
            'isi_catatan' => $request->isi_catatan,
            'user_id' => Auth::id(),
        ]);

        return true;
    }
}
