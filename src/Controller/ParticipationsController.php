<?php

namespace App\Controller;

use App\Entity\Participations;
use App\Form\Participations1Type;
use App\Repository\ParticipationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/participations")
 */
class ParticipationsController extends AbstractController
{
    /**
     * @Route("/", name="participations_index", methods={"GET"})
     */
    public function index(ParticipationsRepository $participationsRepository): Response
    {
        return $this->render('participations/index.html.twig', [
            'participations' => $participationsRepository->findBy([],['score' => 'DESC', 'delta' => 'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="participations_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $participation = new Participations();
        $form = $this->createForm(Participations1Type::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($participation);
            $entityManager->flush();

            return $this->redirectToRoute('participations_index');
        }

        return $this->render('participations/new.html.twig', [
            'participation' => $participation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="participations_show", methods={"GET"})
     */
    public function show(Participations $participation): Response
    {
        return $this->render('participations/show.html.twig', [
            'participation' => $participation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="participations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Participations $participation): Response
    {
        $form = $this->createForm(Participations1Type::class, $participation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('participations_index');
        }

        return $this->render('participations/edit.html.twig', [
            'participation' => $participation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="participations_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Participations $participation): Response
    {
        if ($this->isCsrfTokenValid('delete'.$participation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($participation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('participations_index');
    }
}
