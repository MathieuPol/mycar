<?php

namespace App\Controller\Back;

use App\Repository\BrandRepository;
use App\Repository\CarRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/back")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/main", name="app_back_main")
     */
    public function index(CarRepository $carRepository, UserRepository $userRepository, BrandRepository $brandRepository): Response
    {
        $nbCar = count($carRepository->findAll());
        $nbBrand = count($brandRepository->findAll());
        $nbUser = count($userRepository->findAll());



        return $this->render('back/main/index.html.twig', [
            'nbCar' => $nbCar,
            'nbBrand' => $nbBrand,
            'nbUser' => $nbUser
        ]);
    }




   
}

