<?php

namespace App\Controller;

use App\Entity\Ancv2022;
use App\Entity\Ancv2022commande;
use App\Entity\Users;
use App\Form\Ancv2022_91commandeType;
use App\Form\Ancv2022commandeType;
use App\Repository\Ancv2022commandeRepository;
use App\Repository\Ancv2022Repository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ancv2022')]
class Ancv2022commandeController extends AbstractController
{
    #[Route('/', name: 'app_ancv2022commande_index', methods: ['GET'])]
    public function index(Ancv2022commandeRepository $ancv2022commandeRepository): Response
    {
        return $this->render('ancv2022commande/index.html.twig', [
            'ancv2022commandes' => $ancv2022commandeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ancv2022commande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, Ancv2022commandeRepository $ancv2022commandeRepository, UsersRepository $usersRepository, Ancv2022Repository $ancv2022): Response
    {
        $minCheque = $ancv2022->find(1);

        $usertemp = $usersRepository->find($this->getUser());
        $ancien = date_diff(new \DateTime('2022-03-31'),$usertemp->getDateEntree())->days;

        if($ancien >= $minCheque->getAncien())
        {
            if (empty($ancv2022commandeRepository->findBy(['User' => $this->getUser()])))
            {
                if ($ancien <= 91)
                {
                    $ancv2022commande = new Ancv2022commande();
                    $ancv2022commande->setUser($this->getUser())->setCreatedAt(new \DateTimeImmutable());
                    $form = $this->createForm(Ancv2022_91commandeType::class, $ancv2022commande);
                    $form->handleRequest($request);
                }else
                {
                    $ancv2022commande = new Ancv2022commande();
                    $ancv2022commande->setUser($this->getUser())->setCreatedAt(new \DateTimeImmutable());
                    $form = $this->createForm(Ancv2022commandeType::class, $ancv2022commande);
                    $form->handleRequest($request);
                }


                if ($form->isSubmitted() && $form->isValid()) {
                    $ancv2022commandeRepository->add($ancv2022commande);
                    return $this->redirectToRoute('app_ancv2022commande_index', [], Response::HTTP_SEE_OTHER);
                }

                return $this->renderForm('ancv2022commande/new.html.twig', [
                    'ancv2022commande' => $ancv2022commande,
                    'form' => $form,
                ]);
            }
            $this->addFlash('danger', 'Vous avez déjà fait votre choix !!!');
            return $this->redirectToRoute('app_ancv2022commande_index', [], Response::HTTP_SEE_OTHER);
        }
        $this->addFlash('danger', 'Vous n\'êtes pas élligible aux chèques pour cette année');
        return $this->redirectToRoute('app_ancv2022commande_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}', name: 'app_ancv2022commande_show', methods: ['GET'])]
    public function show(Ancv2022commande $ancv2022commande): Response
    {
        return $this->render('ancv2022commande/show.html.twig', [
            'ancv2022commande' => $ancv2022commande,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ancv2022commande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ancv2022commande $ancv2022commande, Ancv2022commandeRepository $ancv2022commandeRepository): Response
    {
        $form = $this->createForm(Ancv2022commandeType::class, $ancv2022commande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ancv2022commandeRepository->add($ancv2022commande);
            return $this->redirectToRoute('app_ancv2022commande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ancv2022commande/edit.html.twig', [
            'ancv2022commande' => $ancv2022commande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ancv2022commande_delete', methods: ['POST'])]
    public function delete(Request $request, Ancv2022commande $ancv2022commande, Ancv2022commandeRepository $ancv2022commandeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ancv2022commande->getId(), $request->request->get('_token'))) {
            $ancv2022commandeRepository->remove($ancv2022commande);
        }

        return $this->redirectToRoute('app_ancv2022commande_index', [], Response::HTTP_SEE_OTHER);
    }
}
