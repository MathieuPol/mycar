<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class testController extends AbstractController
{
    /**
     * @Route("/front/test", name="app_front_test")
     */
    public function index(): Response
    {
        return $this->render('front/test/index.html.twig', [
            'controller_name' => 'testController',
        ]);
    }
}
