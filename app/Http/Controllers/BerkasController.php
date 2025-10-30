<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\Catatan;
use App\Models\History;
use App\Models\Petugas;
use App\Models\PetugasBerkas;
use App\Models\Proses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BerkasController extends Controller
{
    public function index()
    {
        return view('berkas.index', [
            'title' => 'List Berkas',
            'petugas' => Petugas::all()
        ]);
    }

    public function getBerkas()
    {
        $berkas = Berkas::query()->select('berkas.*')->selectRaw('dt_tanggal.tanggal')
            ->leftJoin(
                DB::raw("(SELECT berkas.id, DATE_FORMAT(berkas.tgl, '%d/%m/%Y') AS tanggal FROM berkas GROUP BY berkas.id) dt_tanggal"),
                'berkas.id',
                '=',
                'dt_tanggal.id'
            )
            ->where('void', 0)->whereNotIn('proses_id', [13, 14])->orderBy('id', 'DESC')->with(['user', 'proses']);

        return datatables()->of($berkas)
            ->addColumn('aksi', function ($data) {
                return '<a href="javascript:void(0)" data-target="#modal_catatan_berkas" class="btn btn-xs mt-2 btn-secondary btn_catatan_berkas" data-toggle="modal" berkas_id="' . $data->id . '"><i class="fas fa-notes-medical"></i> Catatan</a> <a href="javascript:void(0)" data-target="#modal_history_berkas" class="btn btn-xs mt-2 btn-info btn_history_berkas" data-toggle="modal" berkas_id="' . $data->id . '"><i class="fas fa-history"></i> History</a> <a href="javascript:void(0)" data-target="#modal_kembali_berkas" class="btn btn-xs mt-2 btn-warning text-light btn_kembali_berkas" data-toggle="modal" berkas_id="' . $data->id . '" proses_id="' . $data->proses_id . '"><i class="fas fa-arrow-circle-left"></i> Kembali</a> <a href="javascript:void(0)" data-target="#modal_lanjut_berkas" class="btn btn-xs mt-2 btn-success btn_lanjut_berkas" data-toggle="modal" berkas_id="' . $data->id . '" proses_id="' . $data->proses_id . '" pilih_petugas="' . $data->proses->pilih_petugas . '"><i class="fas fa-arrow-circle-right"></i> Lanjut</a>';
            })
            ->addColumn('manipulasi', function ($data) {
                return '<a href="javascript:void(0)" data-target="#modal_edit_berkas" class="btn btn-xs mt-2 btn-primary btn_edit_berkas" data-toggle="modal" berkas_id="' . $data->id . '"><i class="fas fa-edit"></i></a> <a href="javascript:void(0)" class="btn btn-xs mt-2 btn-danger btn_delete_berkas" berkas_id="' . $data->id . '"><i class="fas fa-trash"></i></a>';
            })

            ->rawColumns(['aksi', 'manipulasi'])
            ->addIndexColumn()
            ->make(true);
    }

    public function addBerkas(Request $request)
    {

        $berkas = Berkas::create([
            'proses_id' => 1,
            'no_berkas' => $request->no_berkas,
            'tahun' => $request->tahun,
            'kelurahan' => $request->kelurahan,
            'tgl' => $request->tgl,
            'user_id' => Auth::id(),
            'void' => 0,
        ]);

        History::create([
            'berkas_id' => $berkas->id,
            'proses_id' => 1,
            'tgl' => $request->tgl,
            'user_id' => Auth::id(),
        ]);

        return true;
    }

    public function geteditBerkas($berkas_id)
    {
        return view('berkas.editBerkas', [
            'berkas' => Berkas::where('id', $berkas_id)->first(),
        ])->render();
    }

    public function editBerkas(Request $request)
    {
        Berkas::where('id', $request->id)->update([
            'no_berkas' => $request->no_berkas,
            'tahun' => $request->tahun,
            'kelurahan' => $request->kelurahan,
            'tgl' => $request->tgl,
            'user_id' => Auth::id(),
        ]);

        return true;
    }

    public function deleteBerkas($berkas_id)
    {
        Berkas::where('id', $berkas_id)->update([
            'void' => 1,
            'user_id' => Auth::id(),
        ]);

        History::where('berkas_id', $berkas_id)->update([
            'void' => 1,
            'user_id' => Auth::id(),
        ]);

        PetugasBerkas::where('berkas_id', $berkas_id)->update([
            'void' => 1,
            'user_id' => Auth::id(),
        ]);

        return true;
    }

    public function lanjutBerkas(Request $request)
    {
        Berkas::where('id', $request->berkas_id)->update([
            'proses_id' => $request->proses_id + 1,
            'user_id' => Auth::id(),
        ]);

        History::where('berkas_id', $request->berkas_id)->update(['selesai' => 1]);

        $history = History::create([
            'berkas_id' => $request->berkas_id,
            'proses_id' => $request->proses_id + 1,
            'tgl' => $request->tgl,
            'user_id' => Auth::id(),
        ]);

        if (($request->proses_id + 1) == 13) {
            History::where('berkas_id', $request->berkas_id)->update(['selesai' => 1]);
        }

        $petugas_id = $request->petugas_id;

        if ($petugas_id) {
            for ($count = 0; $count < count($petugas_id); $count++) {

                PetugasBerkas::create([
                    'berkas_id' => $request->berkas_id,
                    'history_id' => $history->id,
                    'proses_id' => $request->proses_id + 1,
                    'petugas_id' => $petugas_id[$count],
                    'tgl' => $request->tgl,
                    'user_id' => Auth::id(),
                    'void' => 0
                ]);
            }
        }



        return true;
    }


    public function getDataCatatan($berkas_id)
    {
        return view('berkas.getDataCatatan', [
            'catatan' => Catatan::where('berkas_id', $berkas_id)->get(),
            'berkas_id' => $berkas_id
        ])->render();
    }

    public function addCatatan(Request $request)
    {
        Catatan::create([
            'isi_catatan' => $request->isi_catatan,
            'tgl' => $request->tgl,
            'berkas_id' => $request->berkas_id,
            'user_id' => Auth::id(),
        ]);
    }

    public function hapusCatatan($catatan_id)
    {
        Catatan::where('id', $catatan_id)->delete();
        return true;
    }

    public function getKembaliBerkas($berkas_id, $proses_id)
    {
        return view('berkas.getKembaliBerkas', [
            'berkas_id' => $berkas_id,
            'proses_id' => $proses_id,
            'proses' => Proses::whereNotIn('id', [1, 13])->get(),
        ])->render();
    }

    public function kembaliBerkas($berkas_id, $proses_id)
    {
        Berkas::where('id', $berkas_id)->update([
            'proses_id' => $proses_id,
            'user_id' => Auth::id(),
        ]);

        History::where('berkas_id', $berkas_id)->update(['selesai' => 1]);

        History::create([
            'berkas_id' => $berkas_id,
            'proses_id' => $proses_id,
            'tgl' => date('Y-m-d'),
            'user_id' => Auth::id(),
            'kembali' => 1
        ]);

        if ($proses_id == 14) {
            History::where('berkas_id', $berkas_id)->update(['selesai' => 1]);
        }

        return true;
    }

    public function historyBerkas($berkas_id)
    {
        return view('berkas.historyBerkas', [
            'berkas_id' => $berkas_id,
            'history' => History::select('history.*')->where('berkas_id', $berkas_id)->with(['petugasBerkas', 'petugasBerkas.petugas', 'proses'])->get(),
        ])->render();
    }

    public function berkasSelesai()
    {
        return view('berkas.berkasSelesai', [
            'title' => 'List Berkas Selesai',
        ]);
    }

    public function getBerkasSelesai()
    {
        $berkas = Berkas::query()->select('berkas.*')->selectRaw('dt_tanggal.tanggal')
            ->leftJoin(
                DB::raw("(SELECT berkas.id, DATE_FORMAT(berkas.tgl, '%d/%m/%Y') AS tanggal FROM berkas GROUP BY berkas.id) dt_tanggal"),
                'berkas.id',
                '=',
                'dt_tanggal.id'
            )
            ->where('void', 0)->where('proses_id', 13)->orderBy('id', 'DESC')->with(['user', 'proses']);

        return datatables()->of($berkas)
            ->addColumn('aksi', function ($data) {
                return '<a href="javascript:void(0)" data-target="#modal_history_berkas" class="btn btn-xs mt-2 btn-info btn_history_berkas" data-toggle="modal" berkas_id="' . $data->id . '"><i class="fas fa-history"></i> History</a>';
            })
            ->rawColumns(['aksi'])
            ->addIndexColumn()
            ->make(true);
    }
}
