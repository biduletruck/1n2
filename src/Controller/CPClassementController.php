<?php

namespace App\Controller;

use App\Entity\CPClassement;
use App\Form\CPClassementType;
use App\Repository\CPClassementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cpclassement')]
class CPClassementController extends AbstractController
{
    #[Route('/', name: 'app_c_p_classement_index', methods: ['GET'])]
    public function index(CPClassementRepository $cPClassementRepository): Response
    {
        return $this->render('cp_classement/index.html.twig', [
            'c_p_classements' => $cPClassementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_c_p_classement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CPClassementRepository $cPClassementRepository): Response
    {
        $cPClassement = new CPClassement();
        $form = $this->createForm(CPClassementType::class, $cPClassement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cPClassementRepository->add($cPClassement, true);

            return $this->redirectToRoute('app_c_p_classement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cp_classement/new.html.twig', [
            'c_p_classement' => $cPClassement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_p_classement_show', methods: ['GET'])]
    public function show(CPClassement $cPClassement): Response
    {
        return $this->render('cp_classement/show.html.twig', [
            'c_p_classement' => $cPClassement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_c_p_classement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CPClassement $cPClassement, CPClassementRepository $cPClassementRepository): Response
    {
        $form = $this->createForm(CPClassementType::class, $cPClassement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cPClassementRepository->add($cPClassement, true);

            return $this->redirectToRoute('app_c_p_classement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cp_classement/edit.html.twig', [
            'c_p_classement' => $cPClassement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_p_classement_delete', methods: ['POST'])]
    public function delete(Request $request, CPClassement $cPClassement, CPClassementRepository $cPClassementRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cPClassement->getId(), $request->request->get('_token'))) {
            $cPClassementRepository->remove($cPClassement, true);
        }

        return $this->redirectToRoute('app_c_p_classement_index', [], Response::HTTP_SEE_OTHER);
    }
}
