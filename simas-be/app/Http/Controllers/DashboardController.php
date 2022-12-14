<?php

namespace App\Http\Controllers;

use App\Models\KualitasAir;
use App\Models\KuantitasAir;
use App\Models\TitikPantau;
use App\Models\WaktuSampling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $time = WaktuSampling::orderBy('waktu', 'DESC')->get();
        if ($time->count()==0) {
            return response(
                [
                    "message" => "Success",
                    "status" => true,
                    "data" => [
                        "ika"=>0,
                        "ika_compare"=>null,
                        "ketinggan_air"=>0,
                        "ketinggian_compare"=>null,
                        "ika_terendah"=>[
                            "ika" => 0,
                            "ika_compare"=>0,
                            "titik_pantau"=>null
                        ],
                        "tingkat_kecemaran"=>null,
                        "grafik_ika"=>[],
                        "grafik_parameter"=>[],
                    ]
                ]
            );
        }
        $ketinggian = KuantitasAir::where('waktu_sampling_id',$time[0]['id'])->avg('ketinggian')??0;
        $ketinggian_before = 0;
        if ($time->count()>1) {
            $ketinggian_before =  KuantitasAir::where('waktu_sampling_id',$time[1]['id'])->avg('ketinggian');
        }
        $ketinggian_comparison = $ketinggian > $ketinggian_before ? 'Naik' : 'Turun';
        $ika = KualitasAir::join('waktu_samplings', 'kualitas_airs.waktu_sampling_id', '=', 'waktu_samplings.id')
                ->where('waktu_samplings.waktu', $time[0]['waktu'])
                ->avg('ika');
        $ika_before = 0;
        if ($time->count()>1) {
            $ika_before = KualitasAir::join('waktu_samplings', 'kualitas_airs.waktu_sampling_id', '=', 'waktu_samplings.id')
                ->where('waktu_samplings.waktu', $time[1]['waktu'])
                ->avg('ika');
        }
        $ika_comparison = $ika > $ika_before ? 'Naik' : 'Turun';
        $min_ika = KualitasAir::join('waktu_samplings', 'kualitas_airs.waktu_sampling_id', '=', 'waktu_samplings.id')
                ->where('waktu_samplings.waktu', $time[0]['waktu'])->min('ika');
               
        $ika_terendah = KualitasAir::where('ika','=',$min_ika)->where('waktu_sampling_id','=',$time[0]['id'])->first()->titik_pantau;
        $ika_terendah['ika'] = $min_ika;
        $ika_terendah_before = 0;
        if ($time->count()>1) {
            $ika_terendah_before = KualitasAir::join('waktu_samplings', 'kualitas_airs.waktu_sampling_id', '=', 'waktu_samplings.id')
            ->where('waktu_samplings.waktu', $time[1]['waktu'])->min('ika');
        }
        $ika_terendah_comparison = $min_ika > $ika_terendah_before?'Naik':"Turun";
        $ika_terendah['ika_compare']=$ika_terendah_comparison;
        $grafik_ika =[];
        $waktu = WaktuSampling::orderBy('waktu', 'DESC')->take(10)->get();
        foreach ($waktu as $item) {
            $data = [
                "ika" => KualitasAir::join('waktu_samplings', 'kualitas_airs.waktu_sampling_id', '=', 'waktu_samplings.id')
                ->where('waktu_samplings.waktu', $item['waktu'])
                ->avg('ika'),
                "tahun"=>$item->tahun,
                "tahap"=>$item->tahap
            ];
            array_push($grafik_ika, $data);
        }
        return response(
            [
                "message" => "Success",
                "status" => true,
                "data" => [
                    "ika"=>$ika,
                    "ika_compare"=>$ika_comparison,
                    "ketinggan_air"=>$ketinggian,
                    "ketinggian_compare"=>$ketinggian_comparison,
                    "ika_terendah"=>$ika_terendah,
                    "tingkat_kecemaran"=>$this->status($ika),
                    "grafik_ika"=>$grafik_ika,
                    "grafik_parameter"=>WaktuSampling::with('kualitas')->orderBy('waktu','DESC')->take(10)->get(),
                ]
            ]
        );

    }

    public function upper()
    {
        $time = WaktuSampling::select('waktu')->orderBy('waktu', 'DESC')->get();
        $ika = KualitasAir::join('waktu_sampling', 'kualitas_airs.waktu_sampling_id', '=', 'waktu_samplings.id')
                ->where('waktu_samplings.waktu', $time[0]['waktu'])
                ->avg('ika');
        $ika_before = 0;
        if ($time->count()>1) {
            $ika_before = KualitasAir::join('waktu_sampling', 'kualitas_airs.waktu_sampling_id', '=', 'waktu_samplings.id')
                ->where('waktu_samplings.waktu', $time[1]['waktu'])
                ->avg('ika');
        }
        $ika_comparison = $ika > $ika_before ? 'Naik' : 'Turun';
        $min_ika = KualitasAir::join('waktu_sampling', 'kualitas_airs.waktu_sampling_id', '=', 'waktu_samplings.id')
                ->where('waktu_samplings.waktu', $time[0]['waktu'])->min('ika');

        return response(
            [
                "message" => "Success",
                "status" => true,
                "data" => [
                    "ika"=>$ika,
                    "ika_comparison"=>$ika_comparison,
                    "ketinggan_air"=>null,
                    "ika_terendah"=>$min_ika,
                    "ketinggian_comparison"=>null,
                    "tingkat_kecemaran"=>$this->status($ika)
                ]
            ]
        );
    }

    private function status($ika)
    {
        if ($ika > 90) {
            return "Sangat Bersih";
        } elseif ($ika > 70) {
            return "Bersih";
        } elseif ($ika > 50) {
            return "Cemar Ringan";
        } elseif ($ika > 25) {
            return "Cemar Berat";
        } else {
            return "Sangat Tercemar";
        }
    }

    public function titikPantau(){
        $titikPantau = TitikPantau::with(['kualitas','kuantitas','foto'])->get();

        return response([
            "message" => "Success",
            "status"=>true,
            "data"=>$titikPantau
        ]);
    }

    public function kualitas(){
        $result= [];
        $index = 0;
        $waktusampling = WaktuSampling::orderBy('waktu', 'DESC')->get();

        foreach ($waktusampling as $item) {
            $result[$index] = $item;
            $result[$index]['kualitas'] = $item->kualitas;
            $index++;
        }

        return response([
            "message" => "Success",
            "status"=>true,
            "data"=>$result
        ]);
    }

    public function laporan(){
        $data = WaktuSampling::orderBy('waktu', 'DESC')->with('kualitas')->paginate(2);
        return response()->json($data,200);
    }


}
