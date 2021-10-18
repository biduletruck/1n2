<?php

namespace App\Controller;

use App\Entity\Package21;
use App\Form\Package21Type;
use App\Repository\Package21Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/package21")
 */
class Package21Controller extends AbstractController
{
    /**
     * @Route("/", name="package21_index", methods={"GET"})
     */
    public function index(Package21Repository $package21Repository): Response
    {
        return $this->render('package21/index.html.twig', [
            'package21s' => $package21Repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="package21_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $package21 = new Package21();
        $form = $this->createForm(Package21Type::class, $package21);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($package21);
            $entityManager->flush();

            return $this->redirectToRoute('package21_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('package21/new.html.twig', [
            'package21' => $package21,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="package21_show", methods={"GET"})
     */
    public function show(Package21 $package21): Response
    {
        return $this->render('package21/show.html.twig', [
            'package21' => $package21,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="package21_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Package21 $package21): Response
    {
        $form = $this->createForm(Package21Type::class, $package21);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('package21_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('package21/edit.html.twig', [
            'package21' => $package21,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="package21_delete", methods={"POST"})
     */
    public function delete(Request $request, Package21 $package21): Response
    {
        if ($this->isCsrfTokenValid('delete'.$package21->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($package21);
            $entityManager->flush();
        }

        return $this->redirectToRoute('package21_index', [], Response::HTTP_SEE_OTHER);
    }
}
