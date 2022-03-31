<?php

declare(strict_types=1);

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Client\ClientExceptionInterface;
use stdClass;

class RouteService
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

    /**
     * @throws ClientExceptionInterface
     */
    public function getRoutesByUnitId(string $dateFrom, string $timeFrom, string $dateTill, string $timeTill, string $unitId): array
    {
        $formattedTime = $this->formatTime($dateFrom, $timeFrom, $dateTill, $timeTill);
        $routesData = $this->client->request( 'GET', 'route/list.json', [
            'query' => [
                'key' => $this->apiKey,
                'from' => $formattedTime->from,
                'till' => $formattedTime->till,
                'unit_id' => $unitId,
                'include' => ['polyline'],
            ],
        ]);

        $routesData = json_decode($routesData->getBody()->getContents(), true);

        return $routesData['data']['units'][0]['routes'] ?? [];
    }

    private function formatTime(string $dateFrom, string $timeFrom, string $dateTill, string $timeTill): stdClass
    {
        $timeInterval = new stdClass();
        $timeInterval->from = $dateFrom . 'T' . $timeFrom . ':00Z';
        $timeInterval->till = $dateTill . 'T' . $timeTill . ':00Z';

        return $timeInterval;
    }
}