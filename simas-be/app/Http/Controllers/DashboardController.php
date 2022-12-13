<?php

namespace App\Http\Controllers;

use App\Models\KualitasAir;
use App\Models\TitikPantau;
use App\Models\WaktuSampling;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(['message' => "OK"]);
    }

    public function upper()
    {
        $time = WaktuSampling::select('waktu')->orderBy('waktu', 'DESC')->get();

        if ($time->count() > 0) {
            $ika = KualitasAir::join('waktu_sampling', 'kualitas_airs.waktu_sampling_id', '=', 'waktu_samplings.id')
                ->where('waktu_samplings.waktu', $time[0]['waktu'])
                ->avg('ika');

            $ika_before = KualitasAir::join('waktu_sampling', 'kualitas_airs.waktu_sampling_id', '=', 'waktu_samplings.id')
                ->where('waktu_samplings.waktu', $time[1]['waktu'])
                ->avg('ika');

            $ika_comparison = $ika > $ika_before ? 'Naik' : 'Turun';

            $min_ika = KualitasAir::join('waktu_sampling', 'kualitas_airs.waktu_sampling_id', '=', 'waktu_samplings.id')
                ->where('waktu_samplings.waktu', $time[1]['waktu'])->min('ika');

            return response($min_ika);
        }

        return response(
            [
                "message" => "Belum ada data",
                "status" => true,
                "data" => [
                    "ika"=>null,
                    "ika_comparison"=>null,
                    "ketinggan_air"=>null,
                    "ika_terendah"=>[
                        "titik_pantau"=>null,
                        "ika"=>null,
                        "ika_comparison"=>null
                    ],
                    "ketinggian_comparison"=>null,
                    "tingkat_kecemaran"=>null
                ]
            ]
        );
    }

    public function titikPantau(){
        $titikPantau = TitikPantau::all();

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
}
