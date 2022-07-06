<?php

namespace App\Controller\Front;

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


class HomeController extends AbstractController
{

    /**
     * permet de génerer la home
     * @Route("/", name="fronthome", methods={"GET"})
     * @return Response
     */
    public function list(CarRepository $carRepository):Response
    {

        //$carList = $carRepository->findCarAndBrand();

//? J'ai essayé le innerjoin mais il m'est impossible d'acceder à la valeur de brand_id dans l'entité car
// Par souci de temps je n'ai pas fait la validation des variables
// sauf certaines me paraissant necessaire

        $carList = $carRepository->findAll();

        return $this->render('main/front/home.html.twig',[
            "carList" => $carList
        ]);
    }



    /**
     * Permet l'affichage d'une seule voiture
     * @Route("/car/{id}", name="showCar", methods={"GET"}, requirements= {"id" = "\d+"})
     *@param int $id
     * @return Response
     */
    public function carShow(Car $car)
    {
        if ($car)
        {
            return $this->render('main/front/carShow.html.twig',[
                "car" => $car
            ]);
        }
    }



/**
 * Permet l'affichage des voitures neuves
 * @Route("/new", name="newCar", methods={"GET"})
 * @return Response
 */
public function newCar(CarRepository $carRepository)
{
    $carList = $carRepository->findBy(array('etat' => 'Neuf'));
    return $this->render('main/front/home.html.twig',[
        "carList" => $carList
    ]);
}

/**
 * Permet l'affichage des voitures neuves
 * @Route("/used", name="usedCar", methods={"GET"})
 * @return Response
 */
public function usedCar(CarRepository $carRepository)
{
    $carList = $carRepository->findBy(array('etat' => 'Occasion'));
    return $this->render('main/front/home.html.twig',[
        "carList" => $carList
    ]);
}

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

    /**
     * Affiche la page description
     * @Route("/description", name="description", methods={"GET"})
     * @return Response
     */
    public function description():Response
    {
        return $this->render('main/front/description.html.twig');
    }



}
