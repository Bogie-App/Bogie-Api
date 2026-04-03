<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Nelmio\ApiDocBundle\Attribute\Model;
use OpenApi\Attributes as OA;
use App\Repository\StationRepository;

class LineController extends AbstractController
{
    #[Route('/api/lines', methods: ['GET'])]
    public function list(StationRepository $repo): JsonResponse
    {
        $stations = $repo->findAllStations();

        $line = [
            'name' => 'mocking line TODO',
            'stations' => $stations,
        ];

        $lines = [
            $line,
            $line,
            $line
        ];

        return $this->json($lines);
    }
}
