<?php

namespace App\Controller;

use App\Entity\CPParticipation;
use App\Form\CPParticipationType;
use App\Repository\CPParticipationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cpparticipation')]
class CPParticipationController extends AbstractController
{
    #[Route('/', name: 'app_c_p_participation_index', methods: ['GET'])]
    public function index(CPParticipationRepository $cPParticipationRepository): Response
    {
        return $this->render('cp_participation/index.html.twig', [
            'c_p_participations' => $cPParticipationRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_c_p_participation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CPParticipationRepository $cPParticipationRepository): Response
    {
        $cPParticipation = new CPParticipation();
        $form = $this->createForm(CPParticipationType::class, $cPParticipation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cPParticipationRepository->add($cPParticipation, true);

            return $this->redirectToRoute('app_c_p_participation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cp_participation/new.html.twig', [
            'c_p_participation' => $cPParticipation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_p_participation_show', methods: ['GET'])]
    public function show(CPParticipation $cPParticipation): Response
    {
        return $this->render('cp_participation/show.html.twig', [
            'c_p_participation' => $cPParticipation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_c_p_participation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CPParticipation $cPParticipation, CPParticipationRepository $cPParticipationRepository): Response
    {
        $form = $this->createForm(CPParticipationType::class, $cPParticipation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cPParticipationRepository->add($cPParticipation, true);

            return $this->redirectToRoute('app_c_p_participation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cp_participation/edit.html.twig', [
            'c_p_participation' => $cPParticipation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_p_participation_delete', methods: ['POST'])]
    public function delete(Request $request, CPParticipation $cPParticipation, CPParticipationRepository $cPParticipationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cPParticipation->getId(), $request->request->get('_token'))) {
            $cPParticipationRepository->remove($cPParticipation, true);
        }

        return $this->redirectToRoute('app_c_p_participation_index', [], Response::HTTP_SEE_OTHER);
    }
}
