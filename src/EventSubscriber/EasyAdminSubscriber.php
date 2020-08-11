<?php

namespace App\EventSubscriber;

use App\Entity\Matches;
use App\Repository\PredictionsRepository;
use Doctrine\ORM\EntityManager;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $match;
    private $predictionsRepository;
    private $entityManager;

    public function __construct(EntityManager $entityManager, PredictionsRepository $predictionsRepository)
    {
        $this->predictionsRepository = $predictionsRepository;
        $this->entityManager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            AfterEntityUpdatedEvent::class => ['updateScoring'],
        ];
    }

    public function updateScoring(AfterEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Matches)) {
            return;
        }
        dump($entity);
        $em = $this->predictionsRepository;
        $game = $em->findGameByPoints($entity);
//

        $resulUsers = $this->predictionsRepository->findUserAsProntosic($entity);
//        dd($resulUsers);
        foreach ($resulUsers as $result)
        {

            $points = 0;
            if ( $result->getPredict() == $entity->getVictory())
            {
                $points +=2;
                if(intval($result->getHomeResult()) === intval($entity->getHomeResult()))
                {
                    $points +=2;
                }
                {
                    $points +=2;
                }
                if((intval($result->getHomeResult()) === intval($entity->getHomeResult())) && (intval($result->getVisitorResult()) === intval($entity->getVisitorResult())))
                {
                    $points +=3;
                }
            }
            $test = $this->predictionsRepository->find($result->getId());
            $test->setPoints($points);
//            dump($test);
            $this->entityManager->persist($test);
        }
//        dd($test);
        $this->entityManager->flush();
        }


}