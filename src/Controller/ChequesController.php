<?php

namespace App\Controller;

use App\Entity\Cheques;
use App\Form\ChequesType;
use App\Repository\ChequesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cheques")
 */
class ChequesController extends AbstractController
{
    /**
     * @Route("/", name="cheques_index", methods={"GET"})
     */
    public function index(ChequesRepository $chequesRepository): Response
    {
        return $this->render('cheques/index.html.twig', [
            'cheques' => $chequesRepository->findAll(),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_SUPERADMIN')", statusCode=404, message="Resource not found.")
     * @Route("/new", name="cheques_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $cheque = new Cheques();
        $form = $this->createForm(ChequesType::class, $cheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($cheque);
            $entityManager->flush();

            return $this->redirectToRoute('cheques_index');
        }

        return $this->render('cheques/new.html.twig', [
            'cheque' => $cheque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')", statusCode=404, message="Resource not found.")
     * @Route("/{id}", name="cheques_show", methods={"GET"})
     */
    public function show(Cheques $cheque): Response
    {
        return $this->render('cheques/show.html.twig', [
            'cheque' => $cheque,
        ]);
    }

    /**
     * @Security("is_granted('ROLE_SUPERADMIN')", statusCode=404, message="Resource not found.")
     * @Route("/{id}/edit", name="cheques_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Cheques $cheque): Response
    {
        $form = $this->createForm(ChequesType::class, $cheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cheques_index');
        }

        return $this->render('cheques/edit.html.twig', [
            'cheque' => $cheque,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_SUPERADMIN')", statusCode=404, message="Resource not found.")
     * @Route("/{id}", name="cheques_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Cheques $cheque): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cheque->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($cheque);
            $entityManager->flush();
        }

        return $this->redirectToRoute('cheques_index');
    }
}
