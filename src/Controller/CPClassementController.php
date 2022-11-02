<?php

namespace App\Controller;

use App\Entity\CPClassement;
use App\Entity\CPParticipation;
use App\Form\CPClassementType;
use App\Repository\CPClassementRepository;
use App\Repository\CPConcoursPhotosRepository;
use App\Repository\CPImagesRepository;
use App\Repository\CPParticipationRepository;


use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/concours2022/classement')]
class CPClassementController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine)
    {

    }

    #[Route('/home', name: 'app_c_p_classement_index', methods: ['GET'])]
    public function index(CPClassementRepository $cPClassementRepository): Response
    {
        return $this->render('cp_classement/index.html.twig', [
            'c_p_classements' => $cPClassementRepository->findAll(),
        ]);
    }

    #[Route('/', name: 'resultat_classement_concours_photos_new', methods: ['GET'])]
    public function classement(CPClassementRepository $cPClassementRepository, CPConcoursPhotosRepository $CPConcoursPhotosRepository): Response
    {
//        dd($cPClassementRepository->findAllResults($concours = $CPConcoursPhotosRepository->findOneBy(['Identifiant' => "Conc2022"])));
        return $this->render('cp_classement/index.html.twig', [
            'c_p_classements' => $cPClassementRepository->findAllResults($concours = $CPConcoursPhotosRepository->findOneBy(['Identifiant' => "Conc2022"])),
        ]);
    }

    #[Route('/new', name: 'classement_concours_photos_new', methods: ['POST'])]
    public function new(Request $request,
                        CPConcoursPhotosRepository $concoursPhotosRepository,
                        CPParticipationRepository $participationRepository,
                        CPImagesRepository $imagesRepository
    ): Response
    {
        if($request->isMethod('post')) {
            $entityManager = $this->doctrine;
            $concours = $concoursPhotosRepository->find($request->request->get('concours'));
            $image = $request->request->keys();

            $newParticipation = new CPParticipation();
            $newParticipation->setUser($this->getUser());
            $newParticipation->setCreatedAt(new \DateTimeImmutable());
            $newParticipation->setConcoursPhotos($concours);
            $entityManager->getManager()->persist($newParticipation);
            $entityManager->getManager()->flush();

        }
        for ( $i=0; $i< $concours->getClassement(); $i++)
        {
            $newClassement = new CPClassement();
            $newClassement
                ->setConcoursPhotos($concours)
                ->setImage($imagesRepository->find($image[$i]))
                ->setUser($this->getUser())
                ->setClassementPhoto(($i+1))
                ->setNombrePoints($concours->getClassement() - $i)
                ->setUpdatedAt(new \DateTimeImmutable());
            $entityManager->getManager()->persist($newClassement);


//            dump($truc[$i]);
        }
        $entityManager->getManager()->flush();
        $this->addFlash('success', 'Merci de votre participation :)');
        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
//        dd($truc);
//        $cPClassement = new CPClassement();
//        $form = $this->createForm(CPClassementType::class, $cPClassement);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $cPClassementRepository->add($cPClassement, true);
//
//            return $this->redirectToRoute('app_c_p_classement_index', [], Response::HTTP_SEE_OTHER);
//        }
//
//        return $this->renderForm('cp_classement/new.html.twig', [
//            'c_p_classement' => $cPClassement,
//            'form' => $form,
//        ]);
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
