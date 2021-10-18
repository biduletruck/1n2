<?php

namespace App\Controller;

use App\Entity\Commande21;
use App\Form\Commande21Type;
use App\Repository\Commande21Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commande21")
 */
class Commande21Controller extends AbstractController
{
    /**
     * @Route("/", name="commande21_index", methods={"GET"})
     */
    public function index(Commande21Repository $commande21Repository): Response
    {
        return $this->render('commande21/index.html.twig', [
            'commande21s' => $commande21Repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commande21_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $commande21 = new Commande21();
        $form = $this->createForm(Commande21Type::class, $commande21);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commande21);
            $entityManager->flush();

            return $this->redirectToRoute('commande21_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commande21/new.html.twig', [
            'commande21' => $commande21,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande21_show", methods={"GET"})
     */
    public function show(Commande21 $commande21): Response
    {
        return $this->render('commande21/show.html.twig', [
            'commande21' => $commande21,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commande21_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commande21 $commande21): Response
    {
        $form = $this->createForm(Commande21Type::class, $commande21);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commande21_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('commande21/edit.html.twig', [
            'commande21' => $commande21,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commande21_delete", methods={"POST"})
     */
    public function delete(Request $request, Commande21 $commande21): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commande21->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commande21);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commande21_index', [], Response::HTTP_SEE_OTHER);
    }
}
