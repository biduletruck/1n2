<?php

namespace App\Controller;

use App\Entity\Choices;
use App\Entity\Questions;
use App\Entity\Task;
use App\Form\ChoicesType;
use App\Repository\ChoicesRepository;
use App\Repository\PollsRepository;
use App\Repository\QuestionsRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/choices")
 */
class ChoicesController extends AbstractController
{
    /**
     * @Route("/", name="choices_index", methods={"GET"})
     * @param ChoicesRepository $choicesRepository
     * @return Response
     */
    public function index(ChoicesRepository $choicesRepository): Response
    {
        return $this->render('choices/index.html.twig', [
            'choices' => $choicesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="choices_new", methods={"GET","POST"})
     * @param Request $request
     * @param PollsRepository $pollsRepository
     * @param QuestionsRepository $questionsRepository
     * @return Response
     */
    public function new(Request $request, PollsRepository $pollsRepository, QuestionsRepository $questionsRepository): Response
    {
        $questions = $questionsRepository->findBy(['Poll' => $pollsRepository->find(2)]);
//        $task = new Task();

        // dummy code - add some example tags to the task
        // (otherwise, the template will render an empty list of tags)
//        foreach ($questions as $question)
//        {
//            $tag = new Choices();
//            $tag->
////            $tag->setParticipation($this->getUser());
//            $task->getTags()->add($tag);
//        }
//        $tag1 = new Choices();
//        $tag1->setName('tag1');
//        $task->getTags()->add($tag1);
//        $tag2 = new Tag();
//        $tag2->setName('tag2');
//        $task->getTags()->add($tag2);
        // end dummy code

//        $form = $this->createForm(ChoicesType::class, $task);
//
//        $form->handleRequest($request);
//
//        $choice = new Choices();
//        $form = $this->createForm(ChoicesType::class, $choice);
//        $form->handleRequest($request);

        $task = new Task();
        /** @Var Questions $questions */
        foreach ($questions as $quest)
        {
            $c = new Choices();
            $c->setQuestion($quest)->setParticipation();
            $task->getTags()->add($c);
        }
                $form = $this->createFormBuilder()
            ->getForm();

        dd($task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            dd($request);
//
//            foreach ($request->get("answers") as $k => $v)
//            {
//                $choice = new Choices();
//                $choice->setQuestion(Question);
//                $choice->addAnswer($v);
//                $choice->setParticipation($this->getUser());
//                $entityManager->persist($choice);
//            }
//            dd($choice);
            $entityManager->flush();

            return $this->redirectToRoute('choices_index');
        }

        return $this->render('choices/new.html.twig', [
//            'choice' => $choice,
            'questions' => $questions,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="choices_show", methods={"GET"})
     * @param Choices $choice
     * @return Response
     */
    public function show(Choices $choice): Response
    {
        return $this->render('choices/show.html.twig', [
            'choice' => $choice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="choices_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Choices $choice
     * @return Response
     */
    public function edit(Request $request, Choices $choice): Response
    {
        $form = $this->createForm(ChoicesType::class, $choice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('choices_index');
        }

        return $this->render('choices/edit.html.twig', [
            'choice' => $choice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="choices_delete", methods={"DELETE"})
     * @param Request $request
     * @param Choices $choice
     * @return Response
     */
    public function delete(Request $request, Choices $choice): Response
    {
        if ($this->isCsrfTokenValid('delete'.$choice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($choice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('choices_index');
    }
}
