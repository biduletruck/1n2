<?php

namespace App\Controller;

use App\Entity\Matches;
use App\Entity\Predictions;
use App\Form\PredictionsType;
use App\Repository\MatchesRepository;
use App\Repository\PredictionsRepository;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/predictions")
 */
class PredictionsController extends AbstractController
{
    /**
     * @Route("/", name="predictions_index", methods={"GET"})
     * @param PredictionsRepository $predictionsRepository
     * @return Response
     */
    public function index(PredictionsRepository $predictionsRepository): Response
    {
        dump(new \DateTime());
        return $this->render('predictions/index.html.twig', [
            'predictions' => $predictionsRepository->findByDay(new \DateTime('now')),
        ]);
    }

    /**
     * @Route("/new", name="predictions_new", methods={"GET","POST"})
     * @param Request $request
     * @param MatchesRepository $matchesRepository
     * @return Response
     */
    public function new(Request $request, MatchesRepository $matchesRepository): Response
    {
        $prediction = new Predictions();
        $Matches = $matchesRepository->find($request->get('id'));
                $prediction->setGame($Matches);
                $prediction->setUser($this->getUser());
        $form = $this->createForm(PredictionsType::class, $prediction);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $predict = new Predictions();
            $predict->setGame($prediction->getGame())
                ->setPredict($prediction->getPredict())
                ->setCreatedAt(new \DateTime())
                ->setUser($prediction->getUser())
                ->setHomeResult($prediction->getHomeResult())
                ->setHomeResult($prediction->getHomeResult());


            $entityManager->persist($prediction);
            $entityManager->flush();

            return $this->redirectToRoute('predictions_index');
        }

        return $this->render('predictions/new.html.twig', [
            'prediction' => $prediction,
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/{id}", name="predictions_show", methods={"GET"})
     * @param Predictions $prediction
     * @return Response
     */
    public function show(Predictions $prediction): Response
    {
        return $this->render('predictions/show.html.twig', [
            'prediction' => $prediction,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="predictions_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Predictions $prediction
     * @return Response
     */
    public function edit(Request $request, Predictions $prediction): Response
    {
        $form = $this->createForm(PredictionsType::class, $prediction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('predictions_index');
        }

        return $this->render('predictions/edit.html.twig', [
            'prediction' => $prediction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/play", name="predictions_play", requirements={"id":"\d+"}, methods={"GET","POST"})
     * @param Request $request
     * @param Predictions $prediction
     * @return Response
     */
    public function play(Request $request, Predictions $prediction): Response
    {
        $form = $this->createForm(PredictionsType::class, $prediction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('predictions_index');
        }

        return $this->render('predictions/edit.html.twig', [
            'prediction' => $prediction,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="predictions_delete", methods={"DELETE"})
     * @param Request $request
     * @param Predictions $prediction
     * @return Response
     */
    public function delete(Request $request, Predictions $prediction): Response
    {
        if ($this->isCsrfTokenValid('delete'.$prediction->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($prediction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('predictions_index');
    }
}
