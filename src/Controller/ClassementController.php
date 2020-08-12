<?php

namespace App\Controller;

use App\Repository\MatchesRepository;
use App\Repository\PredictionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClassementController extends AbstractController
{
    /**
     * @Route("/classement", name="classement")
     * @param MatchesRepository $matchesRepository
     * @param PredictionsRepository $predictionsRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(MatchesRepository $matchesRepository, PredictionsRepository $predictionsRepository)
    {
//        $matches = $matchesRepository->findAllResultMatch();
//        dd($matches);

        foreach ($matchesRepository->findAllResultMatch() as $match)
        {
            $classement = $predictionsRepository->findGameByPoints($match);
            dd($classement);

        }

        return $this->render('classement/index.html.twig', [
            'controller_name' => 'ClassementController',
        ]);
    }
}
