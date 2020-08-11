<?php

namespace App\EventSubscriber;

use App\Entity\Matches;
use App\Entity\Users;
use App\Repository\PredictionsRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityUpdatedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class EasyAdminSubscriber implements EventSubscriberInterface
{

    private $predictionsRepository;
    private $entityManager;
    private $passwordEncoder;

    public function __construct(EntityManager $entityManager, PredictionsRepository $predictionsRepository, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->predictionsRepository = $predictionsRepository;
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public static function getSubscribedEvents()
    {
        return [
            AfterEntityUpdatedEvent::class => ['updateScoring'],
            BeforeEntityPersistedEvent::class => ['addUser'],
            BeforeEntityUpdatedEvent::class => ['updateUser'],
        ];
    }

    public function updateScoring(AfterEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Matches)) {
            return;
        }
        $resulUsers = $this->predictionsRepository->findUserAsProntosic($entity);

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
                if(intval($result->getVisitorResult()) === intval($entity->getVisitorResult()))
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
            $this->entityManager->persist($test);
        }
        $this->entityManager->flush();
    }

    public function updateUser(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Users)) {
            return;
        }
        $this->setPassword($entity);
    }

    public function addUser(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof Users)) {
            return;
        }
        $this->setPassword($entity);
    }

    /**
     * @param Users $entity
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function setPassword(Users $entity): void
    {
        $pass = $entity->getPassword();

        $entity->setPassword(
            $this->passwordEncoder->encodePassword(
                $entity,
                $pass
            )
        );
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }

}