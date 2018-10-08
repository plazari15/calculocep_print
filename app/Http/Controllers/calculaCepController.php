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

    public function buscaFrete(Request $request){
        Log::info('calculaCepController@buscaFrete:: Iniciando a busca de frete');
       $this->validate($request, [
            'cep_destino' => 'required',
            'cep_origem' => 'required',
            'cost_of_goods' => 'required',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'weight' => 'required|numeric',
            'width' => 'required|numeric',
        ]);

        Log::info('calculaCepController@buscaFrete:: Campos válidos');
        $client = new Client([
            'base_uri' => 'https://api.intelipost.com.br',
        ]);

        Log::info('calculaCepController@buscaFrete:: Iniciando POST...');
        $query = [
            'headers' => [
                'api-key' => env('INTELIPOST_API_TOKEN'),
                'platform' => 'intelipost-docs',
                'platform-version' => 'v1.0.0',
                'plugin' => 'intelipost-plugin',
                'plugin-version' => 'v2.0.0',
                'content-type' => 'application/json'
            ],
            'json' => [
                "origin_zip_code" => $request->input('cep_origem'),
                "destination_zip_code" => $request->input('cep_destino'),
                "volumes" => [[
                    "weight" => $request->input('weight'),
                    "volume_type" => 'BOX',
                    "height" => $request->input('height'),
                    "cost_of_goods" => $request->input('cost_of_goods'),
                    "width" => $request->input('width'),
                    "length" => $request->input('length'),
                ]]
            ]
        ];
        Log::debug('calculaCepController@buscaFrete:: Dados a serem enviados', [$query]);

        try{
            $resposta = $client->post('/api/v1/quote', $query);

            $resultado = json_decode($resposta->getBody()->getContents());

            Log::debug('calculaCepController@buscaFrete:: Retorno', [$resultado]);

            if($resultado->status == "OK"){
                Log::debug('calculaCepController@buscaFrete:: Retornou OK');
                return response()->json([
                    'message' => 'Frete localizado',
                    'data' => $resultado,
                    'fretes' => $resultado->content->delivery_options
                ], 200);
            }else{
                Log::debug('calculaCepController@buscaFrete:: Retornou false');
                return response()->json([
                    'message' => 'Frete Não localizado',
                    'data' => $resultado
                ], 200);
            }
        }catch (\Exception $e){
            Log::error('calculaCepController@buscaFrete:: Erro '.$e->getMessage());
            return response()->json([
                'message' => 'Erro no serviço busca de Fretes',
            ], 200);
        }


    }
}
