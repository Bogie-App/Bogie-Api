<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use App\Dto\StationListResponseDto;
use App\Repository\StationRepository;

class StationController extends AbstractController
{
    #[Route('api/stations', methods: ['GET'])]
    #[OA\Response(
        response: 200,
        description: 'Returns a list of stations brief description',
        content: new OA\JsonContent(
            type: 'object',
            items: new OA\Items(ref: new Model(type: StationListResponseDto::class, groups: ['full']))
        )
    )]
    public function list(StationRepository $repo): JsonResponse
    {
        $stations = $repo->findAllStations();

        return $this->json([
            'count' => count($stations),
            'stations' => $stations,
            'status' => 'success',
        ]);
    }
}
