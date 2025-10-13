<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\History;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->query('tgl1')) {
            $tgl1 = $request->query('tgl1');
            $tgl2 = $request->query('tgl2');
        } else {
            $tgl1 = date('Y-m-d', strtotime("-1 month", strtotime(date("Y-m-d"))));
            $tgl2 = date('Y-m-d');
        }

        $periode = History::select('tgl')->selectRaw("COUNT(*) as count")->where('tgl', '>=', $tgl1)->where('tgl', '<=', $tgl2)->where('void', 0)->groupBy('tgl')->get();
        $data_berkas_masuk = History::select('tgl')->selectRaw("COUNT(*) as count")->where('tgl', '>=', $tgl1)->where('tgl', '<=', $tgl2)->where('void', 0)->where('proses_id', 1)->groupBy('tgl')->get();
        $data_berkas_selesai = History::select('tgl')->selectRaw("COUNT(*) as count")->where('tgl', '>=', $tgl1)->where('tgl', '<=', $tgl2)->where('void', 0)->where('proses_id', 13)->groupBy('tgl')->get();

        $data_periode = [];
        $data_periode2 = [];
        $dat_berkas_masuk = [];
        $dat_berkas_selesai = [];

        $tot_berkas_masuk = 0;
        $tot_berkas_selesai = 0;
        foreach ($periode as $pr) {
            $data_periode[] =  date("d/m/Y", strtotime($pr->tgl));
            $data_periode2[] =  date("d/m", strtotime($pr->tgl));

            $dt_berkas_masuk = $data_berkas_masuk->where('tgl', $pr->tgl)->first();
            $dat_berkas_masuk[] = (int) ($dt_berkas_masuk ? $dt_berkas_masuk->count : 0);

            $tot_berkas_masuk += (int) ($dt_berkas_masuk ? $dt_berkas_masuk->count : 0);

            $dt_berkas_selesai = $data_berkas_selesai->where('tgl', $pr->tgl)->first();
            $dat_berkas_selesai[] = (int) ($dt_berkas_selesai ? $dt_berkas_selesai->count : 0);

            $tot_berkas_selesai += (int) ($dt_berkas_selesai ? $dt_berkas_selesai->count : 0);
        }

        $dt_pr = json_encode($data_periode);


        $data_c = [];

        $dt_chart = [];
        $dt_chart['label'] = 'Berkas Masuk';
        // $rc1 = str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
        // $rc2 = str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
        // $rc3 = str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
        $color = 'ffcd57';
        $dt_chart['data'] =  $dat_berkas_masuk;
        $dt_chart['backgroundColor'] = '#' . $color;
        $dt_chart['borderColor'] = '#' . $color;
        $dt_chart['borderWidth'] = 1;
        $dt_chart['color'] = 'green';
        $data_c[] = $dt_chart;

        $dt_chart = [];
        $dt_chart['label'] = 'Berkas Selesai';
        // $rc1 = str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
        // $rc2 = str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
        // $rc3 = str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
        $color = '36a2eb';
        $dt_chart['data'] =  $dat_berkas_selesai;
        $dt_chart['backgroundColor'] = '#' . $color;
        $dt_chart['borderColor'] = '#' . $color;
        $dt_chart['borderWidth'] = 1;
        $dt_chart['color'] = 'green';
        $data_c[] = $dt_chart;


        $dtc = json_encode($data_c);

        $berkas_selesai = Berkas::where('proses_id', 13)->where('void', 0)->count();
        $berkas_belum = Berkas::where('proses_id', '!=', 13)->where('void', 0)->count();

        return view('laporan.index', [
            'title' => 'List Berkas',
            'periode' => $dt_pr,
            'chart' => $dtc,
            'berkas_selesai' => $berkas_selesai ? $berkas_selesai : 0,
            'berkas_belum' => $berkas_belum ? $berkas_belum : 0,
            'dat_berkas_masuk' => $dat_berkas_masuk,
            'dat_berkas_selesai' => $dat_berkas_selesai,
            'data_periode' => $data_periode2,
        ]);
    }
}
