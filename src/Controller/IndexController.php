<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PartnerRepository;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("/mentions-legales", name="legal")
     */
    public function legal()
    {
        return $this->render('index/legal.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("/blessing", name="blessing")
     */
    public function blessing()
    {
        return $this->render('index/blessing.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("/partner/", name="partner")
     */
    public function parnterList(PartnerRepository $rep)
    {
        $array = $rep->findAll();

        return $this->render('index/partner.html.twig', [
            'controller_name' => 'IndexController',
            'partners' => $array,
        ]);
    }
}
