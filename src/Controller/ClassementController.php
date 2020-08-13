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
        $tempClass = [];
        foreach ($matchesRepository->findAllResultMatch() as $match)
        {
            $classement = $predictionsRepository->findGameByPoints($match);
            $point = $predictionsRepository->findClassementPoints();
//            dump($classement);

            $tempClass[] = [$match, $classement];


        }
//        dd($tempClass);
        return $this->render('classement/index.html.twig', [
            'classement' => $tempClass,
            'points' => $point,
        ]);
    }
}
