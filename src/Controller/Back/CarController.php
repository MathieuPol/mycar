<?php

namespace App\Controller\Back;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Car;
use App\Form\CarType;
use App\Repository\CarRepository;
use App\Services\MySlugger;

/**
 * @Route("/back/car")
 */
class CarController extends AbstractController
{
    /**
     * permet de génerer la home
     * @Route("/", name="home", methods={"GET"})
     * @return Response
     */
    public function list(CarRepository $carRepository):Response
    {
        $carList = $carRepository->findAll();

        return $this->render('back/car/list.html.twig',[
            "carList" => $carList
        ]);
    }

    /**
     * gere la route de l'ajout ainsi que le formulaire
     * @Route("/add", name="add", methods={"POST","GET"})
     * @return Response
     */
    public function add(Request $request, ManagerRegistry $doctrine, MySlugger $slug): Response
    {

        $car = new Car;

        $form = $this->createForm(CarType::class, $car);

        //On intercepte la requête
        $form->handleRequest($request);

        //Vérification de base
        if ($form->isSubmitted() && $form->isValid()) {
            $newSlug = $slug->slug($car->getModele());
            $car->setSlug($newSlug);;
            dd($car);
        
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


            return $this->renderForm('back/car/add.html.twig', [
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


                return $this->renderForm('back/car/update.html.twig', [
               'form' => $form,]);
       } 
       



}
