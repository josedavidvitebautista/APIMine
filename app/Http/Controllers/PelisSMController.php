<?php

namespace App\Http\Controllers;

use App\Models\pelisSM;
use App\Http\Requests\StorepelisSMRequest;
use App\Http\Requests\UpdatepelisSMRequest;

class PelisSMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = pelisSM::all();
        return json_decode($index);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     /* @param  \App\Http\Requests\StorepelisSMRequest  $request
     /* @return \Illuminate\Http\Response
     */
    public function store()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://imdb8.p.rapidapi.com/auto-complete?q=spiderman",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: imdb8.p.rapidapi.com",
                "x-rapidapi-key: b7039c1ef0mshfb70f02b771efa1p1eab76jsnaba99f72c875"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo json_decode("cURL Error #:" . $err);
        } else {

            $datosApi = json_decode($response, true);
            $datos = [];

            foreach ($datosApi['d'] as $prop) {
                $datos[] = [
                    'Titulo' => $prop['l'],
                    'Poster' => $prop['i']['imageUrl'],
                    //'Año'=> $prop['y']
                ];
            }

            $store = new pelisSM();
            foreach ($datos as $propi) {
                $store->Titulo = $propi['Titulo'];
                $store->Poster = $propi['Poster'];
                //$store->Año =  $propi['Year'];
                $store->save();
                //echo $ingresodatos;
            }
            echo "<br> Se Agregaron A La Base De Datos!";
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pelisSM  $pelisSM
     * @return \Illuminate\Http\Response
     */
    public function show(pelisSM $pelisSM)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pelisSM  $pelisSM
     * @return \Illuminate\Http\Response
     */
    public function edit(pelisSM $pelisSM)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepelisSMRequest  $request
     * @param  \App\Models\pelisSM  $pelisSM
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepelisSMRequest $request, pelisSM $pelisSM)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pelisSM  $pelisSM
     * @return \Illuminate\Http\Response
     */
    public function destroy(pelisSM $pelisSM)
    {
        //
    }
}
