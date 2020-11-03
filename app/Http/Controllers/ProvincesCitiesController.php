<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Tag\TaggedValue;
use Symfony\Component\Yaml\Parser;

/*
    controller untuk province dan cities

*/

class ProvincesCitiesController extends Controller
{
    //provinces
    public function indexProvinces(Request $request)
    {
        //access api client to get provinces;
        $client     = new Client();
        $request2   = $client->get('https://api.rajaongkir.com/starter/city', [
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

    //untuk search provinces
    public function searchProvinces(Request $request)
    {
        //access api client to get provinces;
        $client = new Client();
        if($request->id != null )
        {

            $url        = "https://api.rajaongkir.com/starter/province?id=$request->id";
            $request2   = $client->get($url,[
                            \GuzzleHttp\RequestOptions::HEADERS      => array(
                                'key'        => '0df6d5bf733214af6c6644eb8717c92c',
                                'Content-Type' => 'application/json',
                                'debug'        => true,
                            )
            ]);
        }
        else
        {
            $request2   = $client->get('https://api.rajaongkir.com/starter/city', [
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

    // cities
    public function indexCities(Request $request)
    {
        //access api client to get city;
        $client = new Client();
        if($request->id != null || $request->province != null)
        {

            $url        = "https://api.rajaongkir.com/starter/city?id=$request->id&province=$request->province";
            $request2   = $client->get($url,[
                            \GuzzleHttp\RequestOptions::HEADERS      => array(
                                'key'        => '0df6d5bf733214af6c6644eb8717c92c',
                                'Content-Type' => 'application/json',
                                'debug'        => true,
                            )
            ]);

        }
        else
        {

            $request2   = $client->get('https://api.rajaongkir.com/starter/city', [
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


    // read yaml
    public function yamlFile()
    {
        //lokasi file yml
        $filepath = base_path('config/file.yml');
        $array = [
            'storages' => [
                'database' => 
                    [
                        'client' => env('SQL_CLIENT'),
                        'connection' => 
                        [
                            'host' => env('SQL_HOST'),
                            'port' => env('SQL_PORT'),
                            'user' => env('SQL_USER'),
                            'password' => env('SQL_PASSWORD'),
                            'database' => env('SQL_DATABASE')
                        ]
                    ]
            ]
        ];

        $yaml = Yaml::dump($array);
        $returnya = file_put_contents($filepath, $yaml);
        $yamlContents = Yaml::parse(file_get_contents($filepath));
        return response()->json($yamlContents);

    }

}
