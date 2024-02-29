<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Inertia\Inertia;
use Illuminate\Support\Facades\Config;


use Illuminate\Http\Request;

class DefinitionController extends Controller
{
    public function show(Request $request)
    {
        $client = new Client();

        try {
            $response = $client->request('GET', 'https://mashape-community-urban-dictionary.p.rapidapi.com/define?term=hatchback', [
                'headers' => [
                    'X-RapidAPI-Host' => 'mashape-community-urban-dictionary.p.rapidapi.com',
                    'X-RapidAPI-Key' => 'c5c5aad276msh0eb78c66df88408p193a29jsn026ef457ea40',
                ],
            ]);

            // Decode the JSON response if it's JSON
            $body = json_decode($response->getBody(), true);

            return Inertia::render('Definitions/Results', [
                'response' => $body,
            ]);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle exception if request fails
            return Inertia::render('Errors/ApiError', [
                'message' => $e->getMessage(),
            ]);
        }
    }
}
