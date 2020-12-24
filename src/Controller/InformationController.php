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
    public function planning(): Response
    {
       // $planning = "";

        return $this->render('information/planning.html.twig', [
            'controller_name' => 'InformationController',
            //'planning' => $planning,
        ]);
    }

    /**
     * @Route("/information/tarif", name="tarif")
     */
    public function tarif(): Response
    {
       // $planning = "";

        return $this->render('information/tarif.html.twig', [
            'controller_name' => 'InformationController',
            //'planning' => $planning,
        ]);
    }

    /**
     * @Route("/information/plan", name="plan")
     */
    public function plan(): Response
    {
       // $planning = "";

        return $this->render('information/plan.html.twig', [
            'controller_name' => 'InformationController',
            //'planning' => $planning,
        ]);
    }
}
