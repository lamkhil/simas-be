<?php

namespace App\Http\Controllers;

use App\Models\KualitasAir;
use App\Models\User;
use App\Models\WaktuSampling;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function register(Request $request)
    {
        $rules = [
            'name' => 'unique:users|required',
            'email'    => 'unique:users|required',
            'password' => 'required',
        ];

        $input     = $request->only('name', 'email', 'password');
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response(
                [
                    "message" => $validator->messages(),
                    "status" => false,
                    "data" => null
                ]
            );
        }

        $name = $request->name;
        $email    = $request->email;
        $password = $request->password;
        $user     = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        return response(
            [
                "message" => "Sip, Oke!",
                "status" => true,
                "data" => $user
            ]
        );
    }

    public function login(Request $request)
    {

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response(
                [
                    "message" => "Email atau password tidak terdaftar",
                    "status" => false,
                    "data" => null
                ]
            );
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('simas')->plainTextToken;
        $user['token'] = $token;

        return response(
            [
                "message" => "Login berhasil",
                "status" => true,
                "data" => $user
            ]
        );
    }

    public function store(Request $request)
    {
        try {
            $ika = $this->indexKualitas($request);
            $ipj = $this->indexPolusi($request);

            $waktu = DateTime::createFromFormat('d-m-Y', $request->waktu);

            $waktuSampling = WaktuSampling::where('tahun', '=', $waktu->format('Y'))
                ->where('tahap', '=', $request->tahap)
                ->first();

            if ($waktuSampling == null) {
                $waktuSampling = WaktuSampling::create([
                    "waktu" => $waktu,
                    "tahun" => $waktu->format("Y"),
                    "tahap" => $request->tahap
                ]);
            }
            $kualitas = KualitasAir::create(
                [
                    "titik_pantau_id" => $request->titik_pantau_id,
                    "user_id" => $request->user()->id,
                    "waktu_sampling_id" => $waktuSampling->id,
                    "suhu" => $request->suhu,
                    "tds" => $request->tds,
                    "warna" => $request->warna,
                    "tss" => $request->tss,
                    "ph" => $request->ph,
                    "bod" => $request->bod,
                    "cod" => $request->cod,
                    "do" => $request->do,
                    "phospat" => $request->phospat,
                    "nitrat" => $request->nitrat,
                    "amonia" => $request->amonia,
                    "arsen" => $request->arsen,
                    "kobalt" => $request->kobalt,
                    "boron" => $request->boron,
                    "selenium" => $request->selenium,
                    "kadium" => $request->kadium,
                    "tembaga" => $request->tembaga,
                    "timbal" => $request->timbal,
                    "merkuri" => $request->merkuri,
                    "seng" => $request->seng,
                    "sianida" => $request->sianida,
                    "flourida" => $request->flourida,
                    "khlorin" => $request->khlorin,
                    "nitrit" => $request->nitrit,
                    "belerang" => $request->belerang,
                    "klorida" => $request->klorida,
                    "minyak" => $request->minyak,
                    "sulfat" => $request->sulfat,
                    "phenol" => $request->phenol,
                    "deterjen" => $request->deterjen,
                    "n_total" => $request->n_total,
                    "nikel" => $request->nikel,
                    "total_koliform" => $request->total_koliform,
                    "fecal_kolifom" => $request->fecal_kolifom,
                    "ika"=>$ika,
                    "ipj"=>$ipj
                ]
            );
            return response([
                "message" => "success",
                "status" => true,
                "data" => $kualitas
            ]);
        } catch (\Throwable $th) {
            return response(
                [
                    "message" => "Server Error",
                    "status" => false,
                    "data" => null
                ],
                401
            );
        }
    }

    public function update(Request $request)
    {
        try {
            $quality = KualitasAir::find($request->id);
            // Getting values from the blade template form
            $ika = $this->indexKualitas($request);
            $ipj = $this->indexPolusi($request);
            $status = $this->status($ika);

            $quality->update(
                [
                    "titik_pantau_id" => $request->titik_pantau_id,
                    "user_id" => $request->user()->id,
                    "ika" => $ika,
                    "ipj" => $ipj,
                    "status" => $status,
                    "suhu" => $request->suhu,
                    "ph" => $request->ph,
                    "dhl" => $request->dhl,
                    "tds" => $request->tds,
                    "tss" => $request->tss,
                    "do" => $request->do,
                    "bod" => $request->bod,
                    "cod" => $request->cod,
                    "no_2" => $request->no_2,
                    "no_3" => $request->no_3,
                    "nh_2" => $request->nh_2,
                    "clorin" => $request->clorin,
                    "total_fosfat" => $request->total_fosfat,
                    "fenol" => $request->fenol,
                    "oil" => $request->oil,
                    "detergent" => $request->detergent,
                    "fecal_coliform" => $request->fecal_coliform,
                    "total_coliform" => $request->total_coliform,
                    "cyanide" => $request->cyanide,
                    "h2s" => $request->h2s,
                ]
            );
            return response(
                [
                    "message" => "Update Success",
                    "status" => true,
                    "data" => null
                ],
                401
            );
        } catch (\Throwable $th) {
            return response(
                [
                    "message" => "Update Error",
                    "status" => false,
                    "data" => null
                ],
                401
            );
        }
    }

    public function delete(Request $request)
    {
        KualitasAir::find($request->id)->delete();
        return response([
            "message" => "Delete Success",
            "status" => true,
            "data" => null
        ]);
    }

    private function indexKualitas(Request $request)
    {
        $ika = 0.00;
        $f1 = $f2 = $f3 = $tesCount = $varCount = $nse = $excursion = $totalExcursion = 0.00;
        $varTotal = $tesTotal = 9.00;
        $ssuhuLow = 22.00;
        $ssuhuHigh = 28.00;
        $sPhLow = 6.00;
        $sPhHigh = 9.00;
        $sTss = 50.00;
        $sDo = 4.00;
        $sBod = 3.00;
        $sCod = 25.00;
        $sTotalFosfat = 0.20;
        $sFecalColiform = 1000.00;
        $sTotalColiform = 5000.00;

        if ($request->suhu < $ssuhuLow && $request->suhu > 0) {
            $varCount++;
            $tesCount++;
            $excursion = ($ssuhuLow / $request->suhu) - 1;
            $totalExcursion = $totalExcursion + $excursion;
        } else if ($request->suhu > $ssuhuHigh) {
            $varCount++;
            $tesCount++;
            $excursion = ($request->suhu / $ssuhuHigh) - 1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->ph < $sPhLow && $request->ph > 0) {
            $varCount++;
            $tesCount++;
            $excursion = ($sPhLow / $request->ph) - 1;
            $totalExcursion = $totalExcursion + $excursion;
        } else if ($request->ph > $sPhHigh) {
            $varCount++;
            $tesCount++;
            $excursion = ($request->ph / $sPhHigh) - 1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->tss > $sTss) {
            $varCount++;
            $tesCount++;
            $excursion = ($request->tss / $sTss) - 1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->do < $sDo  && $request->do > 0) {
            $varCount++;
            $tesCount++;
            $excursion = ($sDo / $request->do) - 1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->bod > $sBod) {
            $varCount++;
            $tesCount++;
            $excursion = ($request->bod / $sBod) - 1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->cod > $sCod) {
            $varCount++;
            $tesCount++;
            $excursion = ($request->cod / $sCod) - 1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->total_fosfat > $sTotalFosfat) {
            $varCount++;
            $tesCount++;
            $excursion = ($request->total_fosfat / $sTotalFosfat) - 1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->fecal_coliform > $sFecalColiform) {
            $varCount++;
            $tesCount++;
            $excursion = ($request->fecal_coliform / $sFecalColiform) - 1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        if ($request->total_coliform > $sTotalColiform) {
            $varCount++;
            $tesCount++;
            $excursion = ($request->total_coliform / $sTotalColiform) - 1;
            $totalExcursion = $totalExcursion + $excursion;
        }

        $nse = $totalExcursion / $tesTotal;
        $f1 = $varCount / $varTotal * 100;
        $f2 = $tesCount / $tesTotal * 100;
        $f3 = $nse / ((0.02 * $nse) + 0.01);

        $ika = 100 - sqrt((($f1 * $f1) + ($f2 * $f2) + ($f3 * $f3)) / 1.732);

        return $ika;
    }

    private function indexPolusi(Request $request)
    {
        $lij = array(25, 7, 50, 4, 3, 25, 0.2, 1000, 5000);
        $ci_max = array(27.00, 8.00, 19.33, 4.2, 11.22, 37.49, 0.3, 960, 4600);
        $ci_lij = array();
        $i = 0;

        $ci_new = ($ci_max[0] - $request->suhu) / ($ci_max[0] - $lij[0]);
        $ci_lij_temp = $ci_new / $lij[0];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        }
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[1] - $request->ph) / ($ci_max[1] - $lij[1]);
        $ci_lij_temp = $ci_new / $lij[1];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        }
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[2] - $request->tss) / ($ci_max[2] - $lij[2]);
        $ci_lij_temp = $ci_new / $lij[2];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        }
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[3] - $request->do) / ($ci_max[3] - $lij[3]);
        $ci_lij_temp = $ci_new / $lij[3];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        }
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[4] - $request->bod) / ($ci_max[4] - $lij[4]);
        $ci_lij_temp = $ci_new / $lij[4];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        }
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[5] - $request->cod) / ($ci_max[5] - $lij[5]);
        $ci_lij_temp = $ci_new / $lij[5];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        }
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[6] - $request->total_fosfat) / ($ci_max[6] - $lij[6]);
        $ci_lij_temp = $ci_new / $lij[6];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        }
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[7] - $request->fecal_coliform) / ($ci_max[7] - $lij[7]);
        $ci_lij_temp = $ci_new / $lij[7];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        }
        array_push($ci_lij, $ci_lij_temp);

        $ci_new = ($ci_max[8] - $request->total_coliform) / ($ci_max[8] - $lij[8]);
        $ci_lij_temp = $ci_new / $lij[8];
        if ($ci_lij_temp > 1) {
            $ci_lij_temp = 1 + (5 * log($ci_lij_temp));
        }
        array_push($ci_lij, $ci_lij_temp);

        $ci_lij_max = max($ci_lij);
        $ci_lij_avg = array_sum($ci_lij) / count($ci_lij);

        $ipj = sqrt((pow($ci_lij_max, 2) - pow($ci_lij_avg, 2) / 2));

        return $ipj;
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
}
