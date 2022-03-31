<?php

declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;

class UnitService
{
    private Client $client;
    private string $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => $_ENV['API_URL'],
        ]);
        $this->apiKey = $_ENV['API_KEY'];
    }

    public function getUnitById(string $unitId)
    {
        $routesData = $this->client->request( 'GET', 'unit/list.json', [
            'query' => [
                'key' => $this->apiKey,
                'unit_id' => $unitId,
            ],
        ]);

        return json_decode($routesData->getBody()->getContents(), true);
    }
}