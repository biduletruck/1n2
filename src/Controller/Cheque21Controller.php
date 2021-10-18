<?php

namespace App\Controller;

use App\Entity\Cheque21;
use App\Form\Cheque21Type;
use App\Repository\Cheque21Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cheque21")
 */
class Cheque21Controller extends AbstractController
{
    /**
     * @Route("/", name="cheque21_index", methods={"GET"})
     */
    public function index(Cheque21Repository $cheque21Repository): Response
    {
        return $this->render('cheque21/index.html.twig', [
            'cheque21s' => $cheque21Repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="cheque21_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cheque21 = new Cheque21();
        $form = $this->createForm(Cheque21Type::class, $cheque21);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cheque21);
            $entityManager->flush();

            return $this->redirectToRoute('cheque21_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cheque21/new.html.twig', [
            'cheque21' => $cheque21,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cheque21_show", methods={"GET"})
     */
    public function show(Cheque21 $cheque21): Response
    {
        return $this->render('cheque21/show.html.twig', [
            'cheque21' => $cheque21,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="cheque21_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cheque21 $cheque21): Response
    {
        $form = $this->createForm(Cheque21Type::class, $cheque21);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cheque21_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cheque21/edit.html.twig', [
            'cheque21' => $cheque21,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="cheque21_delete", methods={"POST"})
     */
    public function delete(Request $request, Cheque21 $cheque21): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cheque21->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cheque21);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cheque21_index', [], Response::HTTP_SEE_OTHER);
    }
}
