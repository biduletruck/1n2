<?php

namespace App\Controller;

use App\Entity\Halloween;
use App\Entity\HalloweenCheck;
use App\Form\HalloweenType;
use App\Repository\HalloweenCheckRepository;
use App\Repository\HalloweenRepository;
use phpDocumentor\Reflection\Types\This;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/halloween")
 */
class HalloweenController extends AbstractController
{
    /**
     * @Route("/", name="halloween_index", methods={"GET"})
     * @param HalloweenCheckRepository $halloweenCheckRepository
     * @return Response
     */
    public function index(HalloweenCheckRepository $halloweenCheckRepository): Response
    {
        $this->container->get('session')->remove('timeForm');
        $halloweenCheck = $halloweenCheckRepository->findBy(['User' => $this->getUser()]);
        if( $halloweenCheck > 0)
        {
            $this->addFlash('info', 'Vous avez déjà participé au quiz !!!');
        }
        return $this->render('halloween/index.html.twig', [
            'halloweenCheck' => count($halloweenCheck),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_SUPERADMIN')", statusCode=404, message="Resource not found.")
     * @Route("/list", name="halloween_list", methods={"GET"})
     * @param HalloweenRepository $halloweenRepository
     * @return Response
     */
    public function list(HalloweenRepository $halloweenRepository, HalloweenCheckRepository $halloweenCheckRepository): Response
    {
        return $this->render('halloween/list.html.twig', [
            'halloweens' => $halloweenRepository->findAll(),
            'halloweenChecks' => $halloweenCheckRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="halloween_new", methods={"GET","POST"})
     * @param Request $request
     * @param HalloweenCheckRepository $halloweenCheckRepository
     * @return Response
     */
    public function new(Request $request, HalloweenCheckRepository $halloweenCheckRepository): Response
    {
        $session = $this->container->get('session');

        if (!$session->has('timeForm'))
        {
            $session->set('timeForm', new \DateTime());
        }

        $halloweenCheck = $halloweenCheckRepository->findBy(['User' => $this->getUser()]);
        if ( count($halloweenCheck) === 0)
        {
            $limiteQuizz = new HalloweenCheck();
            $limiteQuizz->setUser($this->getUser())->setCreatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($limiteQuizz);
            $entityManager->flush();

            $halloween = new Halloween();
            $halloween->setUser($this->getUser());
            $form = $this->createForm(HalloweenType::class, $halloween);
            $form->handleRequest($request);
        }
        else
        {
            $this->addFlash('danger', 'Vous avez déjà participé au quiz !!!');
            return $this->redirectToRoute('halloween_index');

        }


        if ($form->isSubmitted() ) {
//        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $halloween->setFinishedAt(new \DateTime());
            $halloween->setCreatedAt($session->get('timeForm'));
            $session->remove('timeForm');
            $entityManager->persist($halloween);
            $entityManager->flush();
            $this->addFlash('success', 'Votre participation a bien été prise en compte');
            return $this->redirectToRoute('halloween_index');
        }

        return $this->render('halloween/new.html.twig', [
            'halloween' => $halloween,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_SUPERADMIN')", statusCode=404, message="Resource not found.")
     * @Route("/{id}", name="halloween_show", methods={"GET"})
     * @param Halloween $halloween
     * @return Response
     */
    public function show(Halloween $halloween): Response
    {
        return $this->render('halloween/show.html.twig', [
            'halloween' => $halloween,
        ]);
    }

    /**
     * @Security("is_granted('ROLE_SUPERADMIN')", statusCode=404, message="Resource not found.")
     * @Route("/{id}/edit", name="halloween_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Halloween $halloween
     * @return Response
     */
    public function edit(Request $request, Halloween $halloween): Response
    {
        $form = $this->createForm(HalloweenType::class, $halloween);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('halloween_index');
        }

        return $this->render('halloween/edit.html.twig', [
            'halloween' => $halloween,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_SUPERADMIN')", statusCode=404, message="Resource not found.")
     * @Route("/{id}", name="halloween_delete", methods={"DELETE"})
     * @param Request $request
     * @param Halloween $halloween
     * @return Response
     */
    public function delete(Request $request, Halloween $halloween): Response
    {
        if ($this->isCsrfTokenValid('delete'.$halloween->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($halloween);
            $entityManager->flush();
        }

        return $this->redirectToRoute('halloween_index');
    }
}
