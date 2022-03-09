<?php

namespace App\Http\Controllers;

use App\Models\pelisBatman;
use App\Http\Requests\StorepelisBatmanRequest;
use App\Http\Requests\UpdatepelisBatmanRequest;

class PelisBatmanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = pelisBatman::all();
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
     /* @param  \App\Http\Requests\StorepelisBatmanRequest  $request
     /* @return \Illuminate\Http\Response
     */
    public function store()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://imdb8.p.rapidapi.com/auto-complete?q=batman",
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

            $store = new pelisBatman();
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
     * @param  \App\Models\pelisBatman  $pelisBatman
     * @return \Illuminate\Http\Response
     */
    public function show(pelisBatman $pelisBatman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pelisBatman  $pelisBatman
     * @return \Illuminate\Http\Response
     */
    public function edit(pelisBatman $pelisBatman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatepelisBatmanRequest  $request
     * @param  \App\Models\pelisBatman  $pelisBatman
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatepelisBatmanRequest $request, pelisBatman $pelisBatman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pelisBatman  $pelisBatman
     * @return \Illuminate\Http\Response
     */
    public function destroy(pelisBatman $pelisBatman)
    {
        //
    }
}
