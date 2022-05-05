<?php

namespace App\Controller;

use App\Entity\Ancv2022;
use App\Form\Ancv2022Type;
use App\Repository\Ancv2022Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ancv2022create')]
class Ancv2022Controller extends AbstractController
{
    #[Route('/', name: 'app_ancv2022_index', methods: ['GET'])]
    public function index(Ancv2022Repository $ancv2022Repository): Response
    {
        return $this->render('ancv2022/index.html.twig', [
            'ancv2022s' => $ancv2022Repository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ancv2022_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Ancv2022Repository $ancv2022Repository): Response
    {
        $ancv2022 = new Ancv2022();
        $form = $this->createForm(Ancv2022Type::class, $ancv2022);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ancv2022Repository->add($ancv2022);
            return $this->redirectToRoute('app_ancv2022_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ancv2022/new.html.twig', [
            'ancv2022' => $ancv2022,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ancv2022_show', methods: ['GET'])]
    public function show(Ancv2022 $ancv2022): Response
    {
        return $this->render('ancv2022/show.html.twig', [
            'ancv2022' => $ancv2022,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ancv2022_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ancv2022 $ancv2022, Ancv2022Repository $ancv2022Repository): Response
    {
        $form = $this->createForm(Ancv2022Type::class, $ancv2022);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ancv2022Repository->add($ancv2022);
            return $this->redirectToRoute('app_ancv2022_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ancv2022/edit.html.twig', [
            'ancv2022' => $ancv2022,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ancv2022_delete', methods: ['POST'])]
    public function delete(Request $request, Ancv2022 $ancv2022, Ancv2022Repository $ancv2022Repository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ancv2022->getId(), $request->request->get('_token'))) {
            $ancv2022Repository->remove($ancv2022);
        }

        return $this->redirectToRoute('app_ancv2022_index', [], Response::HTTP_SEE_OTHER);
    }
}
