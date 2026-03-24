<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use App\Dto\StationBriefDto;
use App\Dto\StationListResponseDto;
use Doctrine\DBAL\Connection;

class StationController extends AbstractController
{
    private array $stations = [
        ['Id' => 0, 'Name' => 'Name1'],
        ['Id' => 1, 'Name' => 'Name2']
    ];

    #[Route('api/stations', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Returns a list of stations brief description',
        content: new OA\JsonContent(
            type: 'object',
            items: new OA\Items(ref: new Model(type: StationListResponseDto::class, groups: ['full']))
        )
    )]
    public function list(): JsonResponse
    {
        $stations = array_map(
            fn($s) => new StationBriefDto(
                id: $s['Id'],
                name: $s['Name']
            ),
            $this->stations
        );

        $response = new StationListResponseDto(
            count: count($stations),
            stations: $stations,
            status: 'success'
        );

        return $this->json($response);
    }

    #[Route('api/test', methods: ['GET'])]
    public function test(Connection $connection): JsonResponse
    {
        $stations = $connection->fetchAllAssociative(
            'SELECT id, name FROM station'
        );

        return $this->json([
            'count' => count($stations),
            'stations' => $stations,
            'status' => 'success',
        ]);
    }
}
