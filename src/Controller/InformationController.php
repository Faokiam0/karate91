<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InformationController extends AbstractController
{
    /**
     * @Route("/information/planning", name="planning")
     */
    public function index(): Response
    {
       // $planning = "";

        return $this->render('information/planning.html.twig', [
            'controller_name' => 'InformationController',
            //'planning' => $planning,
        ]);
    }
}
