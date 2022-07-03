<?php

namespace App\Controller\Api;

use App\Entity\Car;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use function PHPUnit\Framework\isNull;


/**
 * @Route("/api/car")
 */
class CarController extends AbstractController
{
    /**
     * @Route("", name="app_api_car", methods={"GET"})
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

/**
 * Route permettant d'avoir un modele au format json
 * @Route("/{id}", name="app_read_car", methods={"GET"})
 */
    public function read(Car $car = null):Response
    {
        //*ici on utilise pas la fonction isnull de php car erreur
         if($car === null){
            return $this->json(
                ["erreur" => "modele non trouve"],
                Response::HTTP_NOT_FOUND,
            );
        } 
        return $this->json(
            $car,
            Response::HTTP_OK,
            [],
            [
            "groups" => 
                [
                "showAllCar"
                ]
            ]);
    }


/**
 * Route permettant d'ajouter un modele au format json
 * @Route ("", name = "add", methods= {"POST"})
 */
    public function add(Request $request,
                        CarRepository $carRepository,
                        SerializerInterface $serializerInterface,
                        EntityManagerInterface $doctrine,
                        ValidatorInterface $validator): JsonResponse
{
    $jsonContent = $request->getContent();

    try{

        $car = $serializerInterface->deserialize($jsonContent, Car::class, 'json');
    }
    catch(Exception $e){
        return $this->json("Le JSON est mal formé", Response::HTTP_BAD_REQUEST);
    }

    $errors = $validator->validate($car);
    // Y'a-t-il des erreurs ?
    if (count($errors) > 0) {
        // @todo Retourner des erreurs de validation propres
        return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
    }


    $carRepository->add($car, true);
    return $this->json(
        $car,
        Response::HTTP_CREATED,
        [
            'Location' => $this->generateUrl('app_read_car', ['id' => $car->getId()])
        ]
        );
}


}
