<?php

namespace App\Http\Controllers;

use App\Models\Berkas;
use App\Models\History;
use App\Models\PetugasBerkas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // $laporanPU = PetugasBerkas::select('petugas_berkas.*')->selectRaw("dt_berkas.ttl_berkas, dt_berkas.ttl_selesai, dt_berkas.ttl_tutup")
        //     ->leftJoin(
        //         DB::raw("(SELECT berkas_id, COUNT(id) as ttl_berkas, COUNT(IF(proses_id = 13, 1 ,0)) as ttl_selesai, COUNT(IF(proses_id = 14,1,0)) as ttl_tutup FROM history GROUP BY proses_id) dt_berkas"),
        //         'petugas_berkas.berkas_id',
        //         '=',
        //         'dt_berkas.berkas_id'
        //     )
        //     ->where('void', 0)
        //     ->where('proses_id', 5)
        //     ->groupBy('petugas_berkas.petugas_id')
        //     ->with(['petugas'])
        //     ->get();

        $dat_petugas = PetugasBerkas::select('petugas_id')->where('void', 0)->where('proses_id', 5)->groupBy('petugas_id')->with('petugas')->get();
        $dat_petugas_berkas = PetugasBerkas::select('petugas_id', 'berkas_id')->where('void', 0)->where('proses_id', 5)->groupBy('petugas_id')->groupBy('berkas_id')->get();
        $dat_history = History::where('void', 0)->get();
        $dat_bulan = History::selectRaw("DATE_FORMAT(tgl, '%m/%Y') monthyear, DATE_FORMAT(tgl, '%Y-%m-01') as tgl1, YEAR(tgl) year, MONTH(tgl) month")->groupby('year', 'month')->get();

        $dat_berkas = Berkas::where('void', 0)->get();



        $laporanPU = [];
        foreach ($dat_petugas as $dp) {
            $ttl_berkas = 0;
            $ttl_selesai = 0;
            $ttl_tutup = 0;

            $ttl_pemetaan = 0;
            $ttl_pelaksana = 0;
            $ttl_korsub = 0;
            $ttl_kasi = 0;
            $dt_petugas_berkas = $dat_petugas_berkas->where('petugas_id', $dp->petugas_id)->all();
            foreach ($dt_petugas_berkas as $dpb) {
                $dt_berkas = $dat_history->where('berkas_id', $dpb->berkas_id)->groupBy('berkas_id')->count();
                $dt_selesai = $dat_history->where('berkas_id', $dpb->berkas_id)->where('proses_id', 13)->count();
                $dt_tutup = $dat_history->where('berkas_id', $dpb->berkas_id)->where('proses_id', 14)->count();

                $dt_pemetaan = $dat_berkas->where('id', $dpb->berkas_id)->where('proses_id', 7)->count();
                $dt_pelaksana = $dat_berkas->where('id', $dpb->berkas_id)->whereIn('proses_id', [6, 8, 10, 12])->count();
                $dt_korsub = $dat_berkas->where('id', $dpb->berkas_id)->where('proses_id', 9)->count();
                $dt_kasi = $dat_berkas->where('id', $dpb->berkas_id)->where('proses_id', 11)->count();

                $ttl_berkas += $dt_berkas;
                $ttl_selesai += $dt_selesai;
                $ttl_tutup += $dt_tutup;
                $ttl_pemetaan += $dt_pemetaan;
                $ttl_pelaksana += $dt_pelaksana;
                $ttl_korsub += $dt_korsub;
                $ttl_kasi += $dt_kasi;
            }

            $data_perbulan = [];

            foreach ($dat_bulan as $db) {
                $dat_belum = 0;
                foreach ($dt_petugas_berkas as $dpb2) {
                    $dt_belum = $dat_history->where('tgl', '>=', $db->tgl1)->where('tgl', '<=', date("Y-m-t", strtotime($db->tgl1)))->where('berkas_id', $dpb2->berkas_id)->where('selesai', 0)->where('proses_id', 5)->groupBy('berkas_id')->count();
                    $dat_belum += $dt_belum;
                }

                $data_perbulan[] = $dat_belum;
            }


            $laporanPU[] = [
                'nm_petugas' => $dp->petugas->nm_petugas,
                'ttl_berkas' => $ttl_berkas,
                'ttl_selesai' => $ttl_selesai,
                'ttl_tutup' => $ttl_tutup,
                'data_perbulan' => $data_perbulan,
                'ttl_pemetaan' => $ttl_pemetaan,
                'ttl_pelaksana' => $ttl_pelaksana,
                'ttl_korsub' => $ttl_korsub,
                'ttl_kasi' => $ttl_kasi,

            ];
        }

        $data_tot_bulan = [];
        foreach ($dat_bulan as $db) {
            $dt_ttl_belum = $dat_history->where('tgl', '>=', $db->tgl1)->where('tgl', '<=', date("Y-m-t", strtotime($db->tgl1)))->where('selesai', 0)->where('proses_id', 5)->count();
            $data_tot_bulan[] = ['tgl' => $db->tgl1, 'tot' => $dt_ttl_belum];
        }


        return view('laporan.index', [
            'title' => 'Dashboard',
            'periode' => $dt_pr,
            'chart' => $dtc,
            'berkas_selesai' => $berkas_selesai ? $berkas_selesai : 0,
            'berkas_belum' => $berkas_belum ? $berkas_belum : 0,
            'dat_berkas_masuk' => $dat_berkas_masuk,
            'dat_berkas_selesai' => $dat_berkas_selesai,
            'data_periode' => $data_periode2,
            'laporanPU' => $laporanPU,
            'dat_bulan' => $dat_bulan,
            'data_tot_bulan' => $data_tot_bulan,
        ]);
    }
}
