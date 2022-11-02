<?php

namespace App\Controller;

use App\Entity\CPImages;
use App\Form\CPImagesType;
use App\Repository\CPImagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cpimages')]
class CPImagesController extends AbstractController
{
    #[Route('/', name: 'app_c_p_images_index', methods: ['GET'])]
    public function index(CPImagesRepository $cPImagesRepository): Response
    {
        return $this->render('cp_images/index.html.twig', [
            'c_p_images' => $cPImagesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_c_p_images_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CPImagesRepository $cPImagesRepository): Response
    {
        $cPImage = new CPImages();
        $form = $this->createForm(CPImagesType::class, $cPImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cPImagesRepository->add($cPImage, true);

            return $this->redirectToRoute('app_c_p_images_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cp_images/new.html.twig', [
            'c_p_image' => $cPImage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_p_images_show', methods: ['GET'])]
    public function show(CPImages $cPImage): Response
    {
        return $this->render('cp_images/show.html.twig', [
            'c_p_image' => $cPImage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_c_p_images_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CPImages $cPImage, CPImagesRepository $cPImagesRepository): Response
    {
        $form = $this->createForm(CPImagesType::class, $cPImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cPImagesRepository->add($cPImage, true);

            return $this->redirectToRoute('app_c_p_images_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('cp_images/edit.html.twig', [
            'c_p_image' => $cPImage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_p_images_delete', methods: ['POST'])]
    public function delete(Request $request, CPImages $cPImage, CPImagesRepository $cPImagesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cPImage->getId(), $request->request->get('_token'))) {
            $cPImagesRepository->remove($cPImage, true);
        }

        return $this->redirectToRoute('app_c_p_images_index', [], Response::HTTP_SEE_OTHER);
    }
}
