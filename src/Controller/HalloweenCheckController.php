<?php

namespace App\Controller;

use App\Entity\HalloweenCheck;
use App\Form\HalloweenCheckType;
use App\Repository\HalloweenCheckRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Security("is_granted('ROLE_SUPERADMIN')", statusCode=404, message="Resource not found.")
 * @Route("/halloween/check")
 */
class HalloweenCheckController extends AbstractController
{
    /**
     * @Route("/", name="halloween_check_index", methods={"GET"})
     */
    public function index(HalloweenCheckRepository $halloweenCheckRepository): Response
    {
        return $this->render('halloween_check/index.html.twig', [
            'halloween_checks' => $halloweenCheckRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="halloween_check_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $halloweenCheck = new HalloweenCheck();
        $form = $this->createForm(HalloweenCheckType::class, $halloweenCheck);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($halloweenCheck);
            $entityManager->flush();

            return $this->redirectToRoute('halloween_check_index');
        }

        return $this->render('halloween_check/new.html.twig', [
            'halloween_check' => $halloweenCheck,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="halloween_check_show", methods={"GET"})
     */
    public function show(HalloweenCheck $halloweenCheck): Response
    {
        return $this->render('halloween_check/show.html.twig', [
            'halloween_check' => $halloweenCheck,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="halloween_check_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, HalloweenCheck $halloweenCheck): Response
    {
        $form = $this->createForm(HalloweenCheckType::class, $halloweenCheck);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('halloween_check_index');
        }

        return $this->render('halloween_check/edit.html.twig', [
            'halloween_check' => $halloweenCheck,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="halloween_check_delete", methods={"DELETE"})
     */
    public function delete(Request $request, HalloweenCheck $halloweenCheck): Response
    {
        if ($this->isCsrfTokenValid('delete'.$halloweenCheck->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($halloweenCheck);
            $entityManager->flush();
        }

        return $this->redirectToRoute('halloween_check_index');
    }
}
