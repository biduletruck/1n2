<?php

namespace App\Controller;

use App\Entity\Colis;
use App\Form\ColisType;
use App\Repository\ColisRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/colis")
 */
class ColisController extends AbstractController
{
    /**
     * @Route("/", name="colis_index", methods={"GET"})
     */
    public function index(ColisRepository $colisRepository): Response
    {
        return $this->render('colis/index.html.twig', [
            'colis' => $colisRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="colis_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $coli = new Colis();
        $form = $this->createForm(ColisType::class, $coli);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coli);
            $entityManager->flush();

            return $this->redirectToRoute('colis_index');
        }

        return $this->render('colis/new.html.twig', [
            'coli' => $coli,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="colis_show", methods={"GET"})
     */
    public function show(Colis $coli): Response
    {
        return $this->render('colis/show.html.twig', [
            'coli' => $coli,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="colis_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Colis $coli): Response
    {
        $form = $this->createForm(ColisType::class, $coli);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('colis_index');
        }

        return $this->render('colis/edit.html.twig', [
            'coli' => $coli,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="colis_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Colis $coli): Response
    {
        if ($this->isCsrfTokenValid('delete'.$coli->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($coli);
            $entityManager->flush();
        }

        return $this->redirectToRoute('colis_index');
    }
}
