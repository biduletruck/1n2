<?php

namespace App\Controller;

use App\Entity\Ancv;
use App\Form\AncvType;
use App\Repository\AncvRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/ancv")
 */
class AncvController extends AbstractController
{
    /**
     * @Route("/", name="ancv_index", methods={"GET"})
     */
    public function index(AncvRepository $ancvRepository): Response
    {
        return $this->render('ancv/index.html.twig', [
            'ancvs' => $ancvRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="ancv_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $ancv = new Ancv();
        $form = $this->createForm(AncvType::class, $ancv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ancv);
            $entityManager->flush();

            return $this->redirectToRoute('ancv_index');
        }

        return $this->render('ancv/new.html.twig', [
            'ancv' => $ancv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ancv_show", methods={"GET"})
     */
    public function show(Ancv $ancv): Response
    {
        return $this->render('ancv/show.html.twig', [
            'ancv' => $ancv,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="ancv_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Ancv $ancv): Response
    {
        $form = $this->createForm(AncvType::class, $ancv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('ancv_index');
        }

        return $this->render('ancv/edit.html.twig', [
            'ancv' => $ancv,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="ancv_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Ancv $ancv): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ancv->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($ancv);
            $entityManager->flush();
        }

        return $this->redirectToRoute('ancv_index');
    }
}
