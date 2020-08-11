<?php

namespace App\EventListener;

use App\Entity\Matches;
use App\Entity\Predictions;
use App\Repository\MatchesRepository;
use App\Repository\PredictionsRepository;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;


class DoctrineSubscriber implements EventSubscriber
{

    private $matchesRepository;
    private $predictionsRepository;

    public function __construct(MatchesRepository $matchesRepository, PredictionsRepository $predictionsRepository)
    {
        $this->predictionsRepository = $predictionsRepository;
        $this->matchesRepository = $matchesRepository;
    }


    public function getSubscribedEvents()
    {
        return [
            Events::postUpdate
        ];
    }

//    public function postUpdate(LifecycleEventArgs $args)
//    {
//        $truc = $args->getObject();
//        if(($truc instanceof Matches) && (!($truc instanceof Predictions)))
//        {
//            $resultMatch = $$this->matchesRepository->findResultMatch($truc->getId()) ;
////            dd($resultMatch);
//            $pointByUsers = $$this->predictionsRepository->findAllByPoints();
//
//                $resulUsers = $$this->predictionsRepository->findUserAsProntosic($resultMatch);
////                $entityManager = $args->getObjectManager()->getRepository()->getClassName()
//                foreach ($resulUsers as $result)
//                {
//
//                    $points = 0;
//                    if ( $result->getPredict() == $resultMatch->getVictory())
//                    {
//                        $points +=2;
//                        if(intval($result->getHomeResult()) === intval($resultMatch->getHomeResult()))
//                        {
//                            $points +=2;
//                        }
//                        if (intval($result->getVisitorResult()) === intval($resultMatch->getVisitorResult()))
//                        {
//                            $points +=2;
//                        }
//                        if((intval($result->getHomeResult()) === intval($resultMatch->getHomeResult())) && (intval($result->getVisitorResult()) === intval($resultMatch->getVisitorResult())))
//                        {
//                            $points +=3;
//                        }
//                    }
////                    $test = $$this->predictionsRepository->find($result->getId());
////                    $test->setPoints($points);
////                    $entityManager->persist($test);
//                }
////                $entityManager->flush();
//
//        }
//    }
}