<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class StationController extends AbstractController
{
    #[Route('/stations', name: 'stations_list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $data = [
            'message' => 'Hello Symfony API!',
            'status' => 'success'
        ];

        return $this->json($data);
    }
}
