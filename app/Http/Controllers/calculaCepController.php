<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class calculaCepController extends Controller
{
    /**
     * Form Index Shipping Calculator
     *
     * @return void
     */
    public function index()
    {
        return view('cep.index');
    }

    public function buscaCep(Request $request){

        Log::info('calculaCepController@buscaCep:: Iniciando a busca do CEP');
        if (!$request->has('cep') OR $request->input('cep') == '') {
            Log::info('calculaCepController@buscaCep:: Temos dados faltantes');
           return response()->json([
                'message' => 'CEP Não localizado',
            ], 400);
        }

        Log::info('calculaCepController@buscaCep:: Buscando o CEP no Postmon');

        try{
            $client = new Client([
                'base_uri' => 'https://api.postmon.com.br',
            ]);

            $response = $client->request('GET', '/v1/cep/'.$request->input('cep'));

            $retorno = $response->getBody()->getContents();
            Log::debug('calculaCepController@buscaCep:: RETORNO', [$retorno]);

            return response()->json([
                'message' => 'CEP localizado',
                'dados' => json_decode($retorno)
            ], 200);

        }catch (\Exception $e){
            Log::error('calculaCepController@buscaCep:: Erro::'.$e->getMessage());
            return response()->json([
                'message' => 'CEP Não localizado',
            ], 404);
        }


    }

    //
}
