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
use function Symfony\Component\String\s;

/**
 * @Route("/halloween")
 */
class HalloweenController extends AbstractController
{
    /**
     * @Route("/", name="halloween_index", methods={"GET"})
     * @param HalloweenCheckRepository $halloweenCheckRepository
     * @param HalloweenRepository $halloweenRepository
     * @return Response
     */
    public function index(HalloweenCheckRepository $halloweenCheckRepository, HalloweenRepository $halloweenRepository): Response
    {
        $startTime = new \DateTime("30-10-2020 09:00:00");
        $endTime = new \Datetime('30-10-2020 16:00:00');
        $testDate = new \DateTime();


        if( ($startTime < $testDate) && ($endTime > $testDate)){
            $retest = true;
        }else {
            $retest = true;
//            $retest = false;
        }

        $this->container->get('session')->remove('timeForm');
        $halloweenCheck = $halloweenCheckRepository->findBy(['User' => $this->getUser()]);
        if( count($halloweenCheck) > 0)
        {
            $this->addFlash('info', 'Vous avez déjà participé au quiz !!!');
        }
        return $this->render('halloween/index.html.twig', [
            'halloweenCheck' => count($halloweenCheck),
            'test' => $retest,
        ]);
    }

    /**
     * @Security("is_granted('ROLE_SUPERADMIN')", statusCode=404, message="Resource not found.")
     * @Route("/list", name="halloween_list", methods={"GET"})
     * @param HalloweenRepository $halloweenRepository
     * @param HalloweenCheckRepository $halloweenCheckRepository
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
     * @Route("/classement", name="halloween_classement", methods={"GET"})
     * @param HalloweenRepository $halloweenRepository
     * @return Response
     */
    public function classement(HalloweenRepository $halloweenRepository): Response
    {

        $test = $halloweenRepository->findBy(
            [],
            ['Total' => 'DESC']
        );
        /** @var $test Halloween */
//        $duree = $test->getFinishedAt() - $test->getCreatedAt();
        return $this->render('halloween/classement.html.twig', [
            'halloweens' => $halloweenRepository->findBy(
                [],
                ['Total' => 'DESC']
            ),
//            'duree' => $duree,
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

        if ( count($halloweenCheck) >= 0)
        {
            $limiteQuizz = new HalloweenCheck();
            $limiteQuizz->setUser($this->getUser())->setCreatedAt($session->get('timeForm'));
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
            $result = $halloween->getQuest1()
                + $halloween->getQuest2()
                + $halloween->getQuest3()
                + $halloween->getQuest4()
                + $halloween->getQuest5()
                + $halloween->getQuest6()
                + $halloween->getQuest7()
                + $halloween->getQuest8()
                + $halloween->getQuest9()
                + $halloween->getQuest10();
            $halloween->setTotal($result);
            $halloween->setFinishedAt(new \DateTime());
            $halloween->setCreatedAt($session->get('timeForm'));
            $session->remove('timeForm');
            $entityManager->persist($halloween);
            $entityManager->flush();
            $this->addFlash('success', 'Votre participation a bien été prise en compte et votre score est de : ' . $result . '/10');
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
