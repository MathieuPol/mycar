<?php

namespace App\Controller;

use App\Entity\Brand;
use App\Entity\Car;
use App\Form\CarType;
use App\Repository\BrandRepository;
use App\Repository\CarRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class MainController extends AbstractController
{

         /**
     * Methode de suppression ici on envoi des voiture à la casse
     * @Route("/brand/{id}", name="carBrand", methods={"GET"}, requirements= {"id"="\d+"})
     * @return Response
     * @param int $id
     */
    public function oneBrand(Brand $brand, Request $request, BrandRepository $brandRepository):Response
    {

        if($brand){

            
            $carBrand = $brand->getCars();
            return $this->render('main/brandCar.html.twig',[
                "brand" => $brand,
                "cars" => $carBrand]);
            }
        return $this->redirectToRoute('home');

    }






















}
