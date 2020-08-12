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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/pronostic")
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
        return $this->render('predictions/index.html.twig', [
            'predictions' => $predictionsRepository->findByDay(new \DateTime('now')),
        ]);
    }

    /**
     * @Route("/new", name="predictions_new", methods={"GET","POST"})
     * @param Request $request
     * @param MatchesRepository $matchesRepository
     * @param PredictionsRepository $predictionsRepository
     * @return Response
     */
    public function new(Request $request, MatchesRepository $matchesRepository, PredictionsRepository $predictionsRepository): Response
    {
        $prediction = new Predictions();
        $Matches = $matchesRepository->find($request->get('id'));
                $prediction->setGame($Matches);
                $prediction->setUser($this->getUser());
        $form = $this->createForm(PredictionsType::class, $prediction);

        $preventAnotherPlay = count($predictionsRepository->findIsProntosic($this->getUser(), $request->get('id')));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $alreadyPlay = $predictionsRepository->findIsProntosic($prediction->getUser(), $prediction->getGame());
            $isValidHour = $matchesRepository->isValidHour((new \DateTime())->modify('+1 hours'), $prediction->getGame()->getId());
    
            if (count($alreadyPlay) > 0) {
                $this->addFlash('danger', 'Vous avez déjà fait votre pronostic !!!');
                $this->redirect('matches_index');
            }
            elseif (count($isValidHour) > 0)
            {
                $this->addFlash('danger', 'Trop tard les pronostic sont clos !!!');
                $this->redirect('matches_index');
            }
            else{$entityManager = $this->getDoctrine()->getManager();

                $predict = new Predictions();
                $predict->setGame($prediction->getGame())
                    ->setPredict($prediction->getPredict())
                    ->setCreatedAt(new \DateTime())
                    ->setUser($prediction->getUser())
                    ->setHomeResult($prediction->getHomeResult())
                    ->setHomeResult($prediction->getVisitorResult());

                $entityManager->persist($prediction);
                $entityManager->flush();
                $this->addFlash('success', 'Merci de votre pronostic');
                return $this->redirectToRoute('matches_index');
            }
        }
        return $this->render('predictions/play.html.twig', [
            'prediction' => $prediction,
            'Prevent' => $preventAnotherPlay,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/classement", name="predictions_classement", methods={"GET","POST"})
     * @param Request $request
     * @param MatchesRepository $matchesRepository
     * @param PredictionsRepository $predictionsRepository
     * @return Response
     */
    public function classement(Request $request, MatchesRepository $matchesRepository, PredictionsRepository $predictionsRepository)
    {
        return $this->render('predictions/classement.html.twig');
    }


    /**
     * @Security("is_granted('ROLE_SUPERADMIN')", statusCode=404, message="Resource not found.")
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
     * @Security("is_granted('ROLE_SUPERADMIN')", statusCode=404, message="Resource not found.")
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
     * @Security("is_granted('ROLE_SUPERADMIN')", statusCode=404, message="Resource not found.")
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
