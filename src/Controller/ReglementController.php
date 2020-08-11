<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ReglementController extends AbstractController
{
    /**
     * @Route("/reglement", name="reglement")
     */
    public function index()
    {
        return $this->render('reglement/index.html.twig', [
            'controller_name' => 'ReglementController',
        ]);
    }
}
