<?php

namespace App\Controller\Api;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    /**
     * @Route("/api/car", name="app_api_car")
     */
    public function index(CarRepository $carRepository)
    {
        $allCar = $carRepository->findAll();
    

        return $this->json(
            $allCar,
            200,
            [],
            [
                "groups" => [
                    "showAllCar"
                ]
            ]
        );
    }
}
