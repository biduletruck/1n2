<?php

namespace App\Controller;

use App\Entity\Noel;
use App\Form\NoelType;
use App\Repository\ChequesRepository;
use App\Repository\ColisRepository;
use App\Repository\NoelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/noel")
 */
class NoelController extends AbstractController
{
    /**
     * @Route("/list", name="noel_index", methods={"GET"})
     * @param NoelRepository $noelRepository
     * @return Response
     */
    public function index(NoelRepository $noelRepository): Response
    {
        return $this->render('noel/index.html.twig', [
            'noels' => $noelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="noel_new", methods={"GET","POST"})
     * @param Request $request
     * @param ColisRepository $colisRepository
     * @param ChequesRepository $chequesRepository
     * @return Response
     */
    public function new(Request $request, ColisRepository $colisRepository, ChequesRepository $chequesRepository): Response
    {
        $noel = new Noel();
        $noel->setUser($this->getUser());
        $colis = $colisRepository->findAll();
        $cheques = $chequesRepository->findAll();
        $form = $this->createForm(NoelType::class, $noel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($noel);
            $entityManager->flush();

            return $this->redirectToRoute('noel_index');
        }

        return $this->render('noel/new.html.twig', [
            'noel' => $noel,
            'colis' => $colis,
            'cheques' => $cheques,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="noel_show", methods={"GET"})
     * @param Noel $noel
     * @return Response
     */
    public function show(Noel $noel): Response
    {
        return $this->render('noel/show.html.twig', [
            'noel' => $noel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="noel_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Noel $noel
     * @return Response
     */
    public function edit(Request $request, Noel $noel): Response
    {
        $form = $this->createForm(NoelType::class, $noel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('noel_index');
        }

        return $this->render('noel/edit.html.twig', [
            'noel' => $noel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="noel_delete", methods={"DELETE"})
     * @param Request $request
     * @param Noel $noel
     * @return Response
     */
    public function delete(Request $request, Noel $noel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$noel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($noel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('noel_index');
    }
}
