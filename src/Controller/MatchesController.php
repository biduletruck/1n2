<?php

namespace App\Controller;

use App\Entity\Matches;
use App\Form\MatchesType;
use App\Repository\MatchesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/matches")
 */
class MatchesController extends AbstractController
{
    /**
     * @Route("/", name="matches_index", methods={"GET"})
     * @param MatchesRepository $matchesRepository
     * @return Response
     */
    public function index(MatchesRepository $matchesRepository): Response
    {
        return $this->render('matches/index.html.twig', [
            'matches' => $matchesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/rencontres", name="matches_day", methods={"GET"})
     * @param MatchesRepository $matchesRepository
     * @return Response
     */
    public function indexByBay(MatchesRepository $matchesRepository): Response
    {
        return $this->render('matches/index.html.twig', [
            'matches' => $matchesRepository->findByDay(new \DateTime()),
        ]);
    }

    /**
     * @Route("/new", name="matches_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $match = new Matches();
        $form = $this->createForm(MatchesType::class, $match);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($match);
            $entityManager->flush();

            return $this->redirectToRoute('matches_index');
        }

        return $this->render('matches/new.html.twig', [
            'match' => $match,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="matches_show", methods={"GET"})
     * @param Matches $match
     * @return Response
     */
    public function show(Matches $match): Response
    {
        return $this->render('matches/show.html.twig', [
            'match' => $match,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="matches_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Matches $match
     * @return Response
     */
    public function edit(Request $request, Matches $match): Response
    {
        $form = $this->createForm(MatchesType::class, $match);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('matches_index');
        }

        return $this->render('matches/edit.html.twig', [
            'match' => $match,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="matches_delete", methods={"DELETE"})
     * @param Request $request
     * @param Matches $match
     * @return Response
     */
    public function delete(Request $request, Matches $match): Response
    {
        if ($this->isCsrfTokenValid('delete'.$match->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($match);
            $entityManager->flush();
        }

        return $this->redirectToRoute('matches_index');
    }
}
