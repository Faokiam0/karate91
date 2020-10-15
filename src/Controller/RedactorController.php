<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RedactorController extends AbstractController
{
    /**
     * @Route("/r3d4ct0r", name="redactor")
     */
    public function index()
    {
        return $this->render('redactor/index.html.twig', [
            'controller_name' => 'RedactorController',
        ]);
    }
}
