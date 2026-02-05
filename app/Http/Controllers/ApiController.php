<?php

namespace App\Http\Controllers;

use App\Models\Vacacion;
use App\Traits\JsonTrait;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{

    use JsonTrait;

    function index(): JsonResponse {
        $vacaciones = Vacacion::all();
        return $this->jsonResponse($vacaciones, 'vacacion list');
    }

    function store(Request $request) {
        $vacacion = new Vacacion($request->all());
        try {
            $vacacion->save();
            $result = true;
        } catch(\Exception $e) {
            $vacacion = null;
            $result = false;
        }
        return $this->jsonResponse($vacacion, 'vacacion store', $result);
    }

    function show(string $id): JsonResponse {
        $vacacion = Vacacion::find($id);
        if($vacacion == null) {
            return $this->jsonResponse(null, 'vacacion item', false);
        }
        return $this->jsonResponse($vacacion, 'vacacion item');
    }

    function update(Request $request, string $id) {
    }

    function destroy(string $id) {
    }

    function guzzle($id = 0) {
        $client = new Client([
            'base_uri' => 'https://nico.3utilities.com/',
            'timeout'  => 5.0,
        ]);
        $resultado = session('guzzle', []);
        $resultado = [];
        while($id > 0) {
            $url = "Travel-Agency-App/public/api/vacacion/$id";
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);
            $resultado[] = $data;
            $id = $id - 1;
        }
        dd($resultado);
    }
}
