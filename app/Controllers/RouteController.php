<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\RouteService;
use App\Services\UnitService;
use App\View;
use Psr\Http\Client\ClientExceptionInterface;

class RouteController
{
    private const UNIT_ID = '66466';

    private RouteService $routeService;
    private UnitService $unitService;

    public function __construct()
    {
        $this->routeService = new RouteService();
        $this->unitService = new UnitService();
    }

    public function routes(): string
    {
        $response = [
            'success' => 0,
            'message' => 'message',
            'result' => [],
        ];

        try {
            $dateFrom = $_POST['dateFrom'] ?? '';
            $dateTill = $_POST['dateTill'] ?? '';
            $timeFrom = $_POST['timeFrom'] ?? '';
            $timeTill = $_POST['timeTill'] ?? '';

            $unit = $this->getUnit();
            $unitId = (string)$unit['unit_id'] ?? '';

            if (!$dateFrom || $dateTill || $timeFrom || $timeTill || $unitId) {
                return View::make('index', $response)->render();
            }

            $routeData = $this->routeService->getRoutesByUnitId($dateFrom, $timeFrom, $dateTill, $timeTill, $unitId);
            $response['success'] = 1;
            $response['result'] = json_encode($routeData);
        } catch (ClientExceptionInterface $e) {
            $response['success'] = 0;
            $response['message'] = 'API Error! Code: ' . $e->getCode() . ' Message: ' . $e->getMessage();
        }

        return View::make('routes/index', $response)->render();
    }

    private function getUnit(): array
    {
        $unit = $this->unitService->getUnitById(self::UNIT_ID);

        return $unit['data']['units'][0] ?? [];
    }
}