<?php

namespace App\Http\Controllers;

use App\Models\pelisMarvel;
use Illuminate\Http\Request;
use App\Models\pelisSM;

class APIController extends Controller{

    public function peliculaspiderman(){
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://imdb8.p.rapidapi.com/auto-complete?q=marvel",
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
            echo "cURL Error #:" . $err;
        } else {
            $datosApi = json_decode($response, true);
            $datos = [];

            foreach ($datosApi['d'] as $item){
                $datos[]= [
                    'Titulo'=> $item['l'],
                    'Imagen'=> $item['i']['imageUrl'],
                    //'Year'=> $item['y'],
                ];
            }

            return $datos;

            $ingresodatos = new pelisMarvel();
            foreach ($datos as $propi){
                $ingresodatos->Titulo = $propi['Titulo'];
                $ingresodatos->Imagen =  $propi['Imagen'];
                $ingresodatos->Año =  $propi['Year'];
                $ingresodatos->save();
                echo "<br> Se Agregaron A La Base De Datos!";
                //echo $ingresodatos;
            }
            //return $datos;

        }
    }

    public function indexpelis(){
        $this->peliculaspiderman();
    }
}
