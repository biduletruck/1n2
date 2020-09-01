<?php

namespace App\Controller;

use App\Entity\Bbq;
use App\Entity\BbqEvent;
use App\Form\BbqEvent1Type;
use App\Repository\BbqEventRepository;
use App\Repository\BbqRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bbq/event")
 */
class BbqEventController extends AbstractController
{
    /**
     * @Route("/", name="bbq_event_index", methods={"GET"})
     */
    public function index(BbqEventRepository $bbqEventRepository): Response
    {
        return $this->render('bbq_event/index.html.twig', [
            'bbq_events' => $bbqEventRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bbq_event_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $bbqEvent = new BbqEvent();
        $form = $this->createForm(BbqEvent1Type::class, $bbqEvent);
        $form->handleRequest($request);
        $bbqEvent->setSalarie($this->getUser()) ;
        $bbqEvent->setReglement(0);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bbqEvent);
            $entityManager->flush();
            $this->addFlash('success', 'Votre inscription est prise en compte, n\'oubliez pas la participation de 5€');
            return $this->redirectToRoute('bbq');
        }

        return $this->render('bbq_event/new.html.twig', [
            'bbq_event' => $bbqEvent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bbq_event_show", methods={"GET"})
     */
    public function show(BbqEvent $bbqEvent): Response
    {
        return $this->render('bbq_event/show.html.twig', [
            'bbq_event' => $bbqEvent,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bbq_event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BbqEvent $bbqEvent): Response
    {
        $form = $this->createForm(BbqEvent1Type::class, $bbqEvent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bbq_event_index');
        }

        return $this->render('bbq_event/edit.html.twig', [
            'bbq_event' => $bbqEvent,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bbq_event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, BbqEvent $bbqEvent): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bbqEvent->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bbqEvent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bbq_event_index');
    }
}
