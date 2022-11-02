<?php

namespace App\Controller;

use App\Entity\CPConcoursPhotos;
use App\Form\CPConcoursPhotosType;
use App\Repository\CPConcoursPhotosRepository;
use App\Repository\CPImagesRepository;
use App\Repository\CPParticipationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/concours2022')]
class ConcoursPhotosController extends AbstractController
{
    #[Route('/', name: 'concours_photos_index', methods: ['GET'])]
    public function index(CPConcoursPhotosRepository $cPConcoursPhotosRepository, CPImagesRepository $imagesRepository, CPParticipationRepository $CPParticipationRepository): Response
    {
        $myDate = new \DateTimeImmutable();
        $concours = $cPConcoursPhotosRepository->findOneBy(['Identifiant' => "Conc2022"]);
        if (empty($concours))
        {
            $this->addFlash('danger', "Il n'y aucun concours en cours !");
            return $this->redirectToRoute('home');
        }
        $hasParticipation = $CPParticipationRepository->findOneBy(['ConcoursPhotos' => $concours, 'User' => $this->getUser()]);

        if (empty($hasParticipation))
        {
            if ( $concours->getOpenAt() <= $myDate && $concours->getClosedAt() >= $myDate)
            {
                $images = $imagesRepository->findBy( ['ConcoursPhotos' => $concours]);
                shuffle($images);

                return $this->render('concours2022/index.html.twig', [
                    'concours_photos' => $concours,
                    'images' => $images
                ]);
            }else{
                $this->addFlash('danger', "Il n'y aucun concours en cours !");
                return $this->redirectToRoute('home');
            }
        }
        else {
            $this->addFlash('danger', 'Vous avez déjà participé au concours !!!');
            return $this->redirectToRoute('home');
        }
    }


    #[Route('/new', name: 'concours_photos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CPConcoursPhotosRepository $cPConcoursPhotosRepository): Response
    {
        $cPConcoursPhoto = new CPConcoursPhotos();
        $form = $this->createForm(CPConcoursPhotosType::class, $cPConcoursPhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cPConcoursPhotosRepository->add($cPConcoursPhoto, true);

            return $this->redirectToRoute('app_c_p_concours_photos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cp_concours_photos/new.html.twig', [
            'c_p_concours_photo' => $cPConcoursPhoto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_p_concours_photos_show', methods: ['GET'])]
    public function show(CPConcoursPhotos $cPConcoursPhoto): Response
    {
        return $this->render('cp_concours_photos/show.html.twig', [
            'c_p_concours_photo' => $cPConcoursPhoto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_c_p_concours_photos_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CPConcoursPhotos $cPConcoursPhoto, CPConcoursPhotosRepository $cPConcoursPhotosRepository): Response
    {
        $form = $this->createForm(CPConcoursPhotosType::class, $cPConcoursPhoto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cPConcoursPhotosRepository->add($cPConcoursPhoto, true);

            return $this->redirectToRoute('app_c_p_concours_photos_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cp_concours_photos/edit.html.twig', [
            'c_p_concours_photo' => $cPConcoursPhoto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_p_concours_photos_delete', methods: ['POST'])]
    public function delete(Request $request, CPConcoursPhotos $cPConcoursPhoto, CPConcoursPhotosRepository $cPConcoursPhotosRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cPConcoursPhoto->getId(), $request->request->get('_token'))) {
            $cPConcoursPhotosRepository->remove($cPConcoursPhoto, true);
        }

        return $this->redirectToRoute('app_c_p_concours_photos_index', [], Response::HTTP_SEE_OTHER);
    }
}
