<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class ProvincesController extends Controller
{
    //

    public function indexProvinces(Request $request)
    {
        //access api client to get provinces;
        $client = new Client();
        $request2 = $client->get('https://api.rajaongkir.com/starter/city', [
            \GuzzleHttp\RequestOptions::HEADERS      => array(
                'key'        => '0df6d5bf733214af6c6644eb8717c92c',
                'Content-Type' => 'application/json',
            )
        ]);
        
        $response = $request2->getBody()->getContents();
        return response()->json([
            'success' => true,
            'status' => 200,
            'data'=> $response
        ]);
    }

    public function searchProvinces(Request $request)
    {
        //access api client to get provinces;
        $client = new Client();
        if($request->id != null ){

            $url = "https://api.rajaongkir.com/starter/province?id=$request->id";
            $request2 = $client->get($url,[
                \GuzzleHttp\RequestOptions::HEADERS      => array(
                    'key'        => '0df6d5bf733214af6c6644eb8717c92c',
                    'Content-Type' => 'application/json',
                    'debug'        => true,
                )
            ]);
        }else{
            $request2 = $client->get('https://api.rajaongkir.com/starter/city', [
                \GuzzleHttp\RequestOptions::HEADERS      => array(
                    'key'        => '0df6d5bf733214af6c6644eb8717c92c',
                    'Content-Type' => 'application/json',
                )
            ]);
        }
        

        $response = $request2->getBody()->getContents();
        return response()->json([
            'success' => true,
            'status' => 200,
            'data'=> $response
        ]);
    }



    public function indexCities(Request $request)
    {
        //access api client to get city;
        $client = new Client();
        if($request->id != null || $request->province != null){

            $url = "https://api.rajaongkir.com/starter/city?id=$request->id&province=$request->province";
            $request2 = $client->get($url,[
                \GuzzleHttp\RequestOptions::HEADERS      => array(
                    'key'        => '0df6d5bf733214af6c6644eb8717c92c',
                    'Content-Type' => 'application/json',
                    'debug'        => true,
                )
            ]);
        }else{
            $request2 = $client->get('https://api.rajaongkir.com/starter/city', [
                \GuzzleHttp\RequestOptions::HEADERS      => array(
                    'key'        => '0df6d5bf733214af6c6644eb8717c92c',
                    'Content-Type' => 'application/json',
                )
            ]);
        }
        

        $response = $request2->getBody()->getContents();
        return response()->json([
            'success' => true,
            'status' => 200,
            'data'=> $response
        ]);
    }



}
