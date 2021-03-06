<?php

namespace App\Controller;

use App\Entity\Choices;
use App\Entity\Participations;
use App\Entity\Polls;
use App\Entity\Questions;
use App\Entity\Users;
use App\Form\ChoicesType;
use App\Form\ColisType;
use App\Form\ParticipationsType;
use App\Form\QuestionType;
use App\Repository\AnswersRepository;
use App\Repository\ParticipationsRepository;
use App\Repository\PollsRepository;
use App\Repository\QuestionsRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Choice;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/bbq", name="bbq")
     */
    public function bbq()
    {
        return $this->render('bbq/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    /**
     * @Route("/summer_game", name="summer_game")
     */
    public function summer_game(PollsRepository $pollsRepository)
    {
        $open = new \DateTime();
        return $this->render('/Summer_game/summer_index.html.twig', [
            'poll' => $pollsRepository->find(1),
            'open' => $open
        ]);
    }


    /**
     * @Route("/summer_game_play", name="summer_game_play")
     */
    public function summer_game_play(UsersRepository $usersRepository, AnswersRepository $answersRepository, QuestionsRepository $questionsRepository, Request $request, PollsRepository $pollsRepository, ParticipationsRepository $participationsRepository): Response
    {

        $participationDate = new \DateTime();
        $entityManager = $this->getDoctrine()->getManager();
        if($request->isMethod('post'))
        {

            $participation = $participationsRepository->findOneBy (['User' => $this->getUser()]);
            $pollRepo = $entityManager->getRepository(Polls::class);
            $participation->getPoll();

            $poll = $pollsRepository->find(1);


            $questions = $poll->getQuestions();

            $result = $request->request;
            $totalPoints = 0;
            $heureValidation = new \DateTime();
            foreach ($result as $q => $r)
           {
                // Choix pour la première question
                $questionOne = $questions->get($q);
                $answers = $answersRepository->find($r);
                $totalPoints += $answers->getAnswerValue();
                $choice = new Choices();
                $choice->setQuestion($questionOne);
                $choice->addAnswer($answers);

                $entityManager->persist($choice);
                $participation->addChoice($choice);
                $entityManager->flush();
            }
            $participation->setScore($totalPoints);
            $participation->setDateValidation($heureValidation);
            $dateDiff = $heureValidation->diff($participation->getCreatedAt());
            $participation->setDelta($dateDiff->s);
            $entityManager->persist($participation);
            $entityManager->flush();


            $this->addFlash('success', 'merci de votre participation, vous avez eu ' . $totalPoints . '/5');
            return $this->redirectToRoute('home');

        }


        // On verifie que le questionnaire est ouvert !
        if ($participationDate >= $pollsRepository->find(1)->getOpenAt() && $participationDate <= $pollsRepository->find(1)->getClosedAt())
        {
            // On verifie que le joueur n'a pas déjà joué !
            if ($participationsRepository->findOneBy(["User" => $this->getUser()]) !== null)
            {
                $this->addFlash('danger', 'Vous avez déjà participé au quizz !!');
                return $this->redirectToRoute('home');
            }

            $participation = new Participations();
            $participation->setCreatedAt(new \DateTime());
            $pollRepo = $entityManager->getRepository(Polls::class);
            $poll = $pollsRepository->find(1);
            $participation->setUser($this->getUser());
            $participation->setPoll($poll);
            $entityManager->persist($participation);
            $entityManager->flush(); // Nous devons flusher une premiére fois pour avoir un identifiant pour la participation


            for ($i = 1; $i <= 5; $i++) {
                $rand = random_int(1, 25);

                $a = random_int(1, 25);
                $b = random_int(1, 25);
                while($b == $a )
                {
                    $b = random_int(1, 25);
                }
                $c = random_int(1, 25);
                while($c == $a || $c == $b)
                {
                    $c = random_int(1, 25);
                }
                $d = random_int(1, 25);
                while($d == $a || $d == $b || $d == $c)
                {
                    $d = random_int(1, 25);
                }
                $e = random_int(1, 25);
                while($e == $a || $e == $b || $e == $c || $e == $d)
                {
                    $e = random_int(1, 25);
                }
            }

            $a = $questionsRepository->find($a);
            $b = $questionsRepository->find($b);
            $c = $questionsRepository->find($c);
            $d = $questionsRepository->find($d);
            $e = $questionsRepository->find($e);

            return $this->render('/Summer_game/game.html.twig', [
                'form' => [$a, $b, $c, $d, $e],
                'poll' => $pollsRepository->find(1)

            ]);
        }
        $this->addFlash('danger', 'la participation à ce quizz est fermé');
        return $this->redirectToRoute('summer_game');

    }
}
