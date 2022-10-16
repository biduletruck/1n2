<?php

namespace App\Controller;


use App\Entity\Commande21;
use App\Entity\Noel;
use App\Entity\Users;
use App\Form\Commande21LightType;
use App\Form\Commande21Type;
use App\Form\NoelType;
use App\Repository\Cheque21Repository;
use App\Repository\ChequesRepository;
use App\Repository\ColisRepository;
use App\Repository\Commande21Repository;
use App\Repository\NoelRepository;
use App\Repository\Package21Repository;
use App\Repository\UsersRepository;
use phpDocumentor\Reflection\Types\True_;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/noel")
 */
class NoelController extends AbstractController
{
    /**
     * @Security("is_granted('ROLE_ADMIN')", statusCode=404, message="Resource not found.")
     * @Route("/list", name="noel_index", methods={"GET"})
     * @param Commande21Repository $noelRepository
     * @return Response
     */
    public function index(Commande21Repository $noelRepository,
                          UsersRepository $usersRepository,
                          Package21Repository $package21Repository,
                          Cheque21Repository $cheque21Repository): Response
    {
        return $this->render('noel/index.html.twig', [
            'salaries' =>$usersRepository->findBy(["isActive" =>true],['Nom' => 'ASC']),
            'countUsers' => $usersRepository->countSalaries(),
            'countCommandes' => $noelRepository->countCommandes(),
            'countCheques' => $noelRepository->countCommandesByCheque(),
            'countPackages' => $noelRepository->countCommandesByType(),
            'noels' => $noelRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="noel_new", methods={"GET","POST"})
     * @param Request $request
     * @param UsersRepository $users
     * @param Commande21Repository $colisRepository
     * @param Package21Repository $package
     * @param Cheque21Repository $chequesRepository
     * @return Response
     */
    public function new(Request $request, UsersRepository $users, Commande21Repository $colisRepository, Package21Repository $package, Cheque21Repository $chequesRepository): Response
    {
        $control = count($colisRepository->findBy(['salarie' => $this->getUser()]));
        $noel = new Commande21();
        $noel->setSalarie($users->find($this->getUser()));

        $colis = $package->findAll();

        $cheques = null;
        $form = $this->createForm(Commande21LightType::class, $noel);
        if ($users->find($this->getUser())->getDateEntree() < new \DateTime('2022-10-31') )
        {
            $cheques = $chequesRepository->findBy(['profile' => True]);
            $form = $this->createForm(Commande21Type::class, $noel);
        }


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($noel);
            $entityManager->flush();
            $this->addFlash('success', 'Merci, votre demande est prise en compte');
            return $this->redirectToRoute('noel_new');
        }


        return $this->render('noel/new.html.twig', [
            'noel' => $noel,
            'colis' => $colis,
            'control' =>$control,
            'cheques' => $cheques,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_SUPERADMIN')", statusCode=404, message="Resource not found.")
     * @Route("/{id}", name="noel_show", methods={"GET"})
     * @param Noel $noel
     * @return Response
     */
    public function show(Noel $noel): Response
    {
        return $this->render('noel/show.html.twig', [
            'noel' => $noel,
        ]);
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')", statusCode=404, message="Resource not found.")
     * @Route("/{id}/edit", name="noel_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Noel $noel
     * @return Response
     */
    public function edit(Request $request, Noel $noel): Response
    {
        $form = $this->createForm(NoelType::class, $noel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('noel_index');
        }

        return $this->render('noel/edit.html.twig', [
            'noel' => $noel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_SUPERADMIN')", statusCode=404, message="Resource not found.")
     * @Route("/{id}", name="noel_delete", methods={"DELETE"})
     * @param Request $request
     * @param Noel $noel
     * @return Response
     */
    public function delete(Request $request, Noel $noel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$noel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($noel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('noel_index');
    }

    /**
     * Export du voyage au format Excel
     *
     * @Route("/export/xls", name="voyage_export_xls_package")
     * @return void
     */
    public function exportExcelVoyageAction()
    {


        list($excel, $classeur, $titre) = $this->formatingExtract();
        return $excel->exportExcel($classeur, $titre);
    }


    /**
     */
    public function formatingExtract()
    {
        $em = $this->getDoctrine()->getManager();
        $listing = $em->getRepository('App:Noel')->findAll();

        $excel = $this->container->get('app.excel_service');
        $classeur = $excel->newExcelFromModel();
        $feuille = $classeur->getActiveSheet();
        $titre = "Liste des commandes de noel";


        dump($listing);

    }
}
