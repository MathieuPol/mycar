<?php

namespace App\Controller\Back;

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
    public function index(): Response
    {
        return $this->render('back/main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }




   
}

