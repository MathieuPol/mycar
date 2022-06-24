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

//*N'étant pas demandé dans l'exercice pas de routes pour l'ajout de brand
//*Une méthode à cependant été ajouté en fixture pour avoir des données factices

    /**
     * permet de génerer la home
     * @Route("/", name="home", methods={"GET"})
     * @return Response
     */
    public function list(CarRepository $carRepository):Response
    {

        //$carList = $carRepository->findCarAndBrand();

//? J'ai essayé le innerjoin mais il m'est impossible d'acceder à la valeur de brand_id dans l'entité car
// Par souci de temps je n'ai pas fait la validation des variables
// sauf certaines me paraissant necessaire

        $carList = $carRepository->findAll();

        return $this->render('main/index.html.twig',[
            "carList" => $carList
        ]);
    }


    /**
     * gere la route de l'ajout ainsi que le formulaire
     * @Route("/add", name="add", methods={"POST","GET"})
     * @return Response
     */
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $car = new Car;

        $form = $this->createForm(CarType::class, $car);

        //On intercepte la requête
        $form->handleRequest($request);

        //Vérification de base
        if ($form->isSubmitted() && $form->isValid()) {

        
        //Ajout de flash message pour l'ajout correct du formulaire
            $this->addFlash(
                'success',
                'Votre véhicule a été ajouté avec succes.'
            );

            // On va faire appel au Manager de Doctrine
            $entityManager = $doctrine->getManager();

            //On fait persister notre car et on l'envoie dans la bdd
            $entityManager->persist($car);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }


            return $this->renderForm('main/add.html.twig', [
            'form' => $form,]);
    }


    /**
     * Methode de suppression ici on envoi des voiture à la casse
     * @Route("/car/delete/{id}", name="carDelete", methods={"POST"}, requirements= {"id"="\d+"})
     * @return Response
     * @param int $id
     */
     public function delete(Car $car, CarRepository $carRepository):Response
     {
//Ici on vérifie mais cela n'est pas necessaire
//la méthode de recupétation de l'objet car renvoi une 404 si non trouvé
//Une méthode de suppression n'étant pas anodyne cela m'a paru plus sécurisant

        if ($car) {
            $carRepository->remove($car, true);
            //  $carRepository->remove($car);
            $this->addFlash(
                'success',
                'Suppression effectuée avec succes'
            );
            return $this->redirectToRoute('home');
        }
        $this->addFlash(
            'warning',
            'La suppression à échouée'
        );
        return $this->redirectToRoute('home');
     }

         /**
     * Methode de mise à jout ici on envoi des voiture à la casse
     * @Route("/car/update/{id}", name="carUpdate", methods={"GET", "POST"}, requirements= {"id"="\d+"})
     * @return Response
     * @param int $id
     */
    public function update(Car $car,  ManagerRegistry $doctrine, Request $request):Response
    {

        $form = $this->createForm(CarType::class, $car);
        
        //On intercepte la requête
        $form->handleRequest($request);

        //Vérification de base
         if ($form->isSubmitted() && $form->isValid()) {
          
                
            //Ajout de flash message pour l'ajout correct du formulaire
                $this->addFlash(
                    'success',
                    'Votre véhicule a été mis à jour avec succes.'
                );

                // On va faire appel au Manager de Doctrine
                $entityManager = $doctrine->getManager();

                //On fait persister notre car et on l'envoie dans la bdd
                $entityManager->persist($car);
                $entityManager->flush();

                return $this->redirectToRoute('home');
            }


                 return $this->renderForm('main/update.html.twig', [
                'form' => $form,]);
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




















}
