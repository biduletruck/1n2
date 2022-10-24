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
//        return $this->render('home/index.html.twig', [
//            'controller_name' => 'HomeController',
//        ]);
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
     * @Route ("/quiz", name="quiz")
     */

    public function quiz_game(PollsRepository $pollsRepository, ParticipationsRepository $participationsRepository, UsersRepository $users, QuestionsRepository $questionsRepository)
    {
        //On vérifie qu'un quiz est ouvert
        $openPoll = $pollsRepository->findQuizIsOpen(new \DateTime());
        if (empty($openPoll))
        {
            $openPoll = $pollsRepository->findNextQuiz((new \DateTime()));
            if (empty($openPoll))
            {
                $openPoll = $pollsRepository->findOneBy(["DefaultPoll" => 1]);
            }
        }
//        else {
//            $this->addFlash('danger', 'la participation à ce quizz est fermé');
//            return $this->redirectToRoute('quiz');
//        }

//        //on vérifie la participation à ce quiz
//        $participation = $participationsRepository->findParticipation($users->find($this->getUser())->getId(), $openPoll->getId() );
//
//        //si aucune particiaption alors ...
//       if(empty($participation))
//       {
//           // on recherche les catégories de question
//           $Categorys = $questionsRepository->findCategorysInQuestion($openPoll->getId());
//           $questions = [];
//           foreach ( $Categorys as $category)
//               {
//                   //on recherche le nombre de questions par catégorie
//                   $nbQuestion = $questionsRepository->countQuestionsInCategory($category['category']);
////                 //tire au sort 1 question au hasard par catégorie
//                    $questions[] = $questionsRepository->find(random_int(1, $nbQuestion["nbQuestion"]));
//               }
////
//       }
           return $this->render('quiz/quiz_index.html.twig', [
               'poll' => $pollsRepository->find($openPoll->getId()),
               'open' => new \DateTime()
           ]);


    }

    /**
     * @Route("/quiz_play", name="quiz_play")
     */
    public function quiz_play(UsersRepository $usersRepository,
                                        AnswersRepository $answersRepository,
                                        QuestionsRepository $questionsRepository,
                                        Request $request,
                                        PollsRepository $pollsRepository,
                                        ParticipationsRepository $participationsRepository): Response
    {
        $participationDate = new \DateTime();
        $entityManager = $this->getDoctrine()->getManager();
        if($request->isMethod('post'))
        {
//            dd($request->request->get("poll"));
            $participation = $participationsRepository->findOneBy (['User' => $this->getUser(),'Poll' => $pollsRepository->find($request->request->get("poll"))]);

            $pollRepo = $entityManager->getRepository(Polls::class);
            $participation->getPoll();

            $poll = $pollsRepository->find($request->request->get("poll"));

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

        //On vérifie qu'un quiz est ouvert
        $openPoll = $pollsRepository->findQuizIsOpen(new \DateTime());

        if (empty($openPoll))
        {
            $openPoll = $pollsRepository->findNextQuiz((new \DateTime()));

        }
//        else {
//            $this->addFlash('danger', 'la participation à ce quizz est fermé');
//            return $this->redirectToRoute('quiz');
//        }

        //on vérifie la participation à ce quiz
        $participation = $participationsRepository->findParticipation($usersRepository->find($this->getUser())->getId(), $openPoll->getId() );

        //si aucune particiaption alors ...
        if(empty($participation)) {

            $participation = new Participations();
            $participation->setCreatedAt(new \DateTime());
            $pollRepo = $entityManager->getRepository(Polls::class);
            $poll = $pollsRepository->find($openPoll->getId());
            $participation->setUser($this->getUser());
            $participation->setPoll($poll);
            $entityManager->persist($participation);
            $entityManager->flush(); // Nous devons flusher une premiére fois pour avoir un identifiant pour la participation

            // on recherche les catégories de question
            $Categorys = $questionsRepository->findCategorysInQuestion($openPoll->getId());
            $questions = [];
            foreach ($Categorys as $category) {
                //on recherche le nombre de questions par catégorie
                $listQuestions = $questionsRepository->QuestionsInCategory($category['category']);
                $listing = [];
                foreach ($listQuestions as $list)
                {
                    $listing[] = $list["Questions"];
                }
                //tire au sort 1 question au hasard par catégorie
                $questions[] = $questionsRepository->findBy(["Difficulty" => $category['category'], "QuestionNumber" => $listing[array_rand($listing,1)]]);

            }
//            dd($questions);
        }
        else{
                $this->addFlash('danger', 'Vous avez déjà participé au quiz !!');
                return $this->redirectToRoute('home');
        }

            return $this->render('quiz/quiz_game.html.twig', [
                'form' => $questions,
                'poll' => $pollsRepository->find($openPoll->getId()),

            ]);
    }


//
//
//    /**
//     * @Route("/halloween2021_game", name="halloween_game")
//     */
//    public function halloween_game(PollsRepository $pollsRepository)
//    {
//        $open = new \DateTime();
//        return $this->render('halloween2021/quiz_index.html.twig', [
//            'poll' => $pollsRepository->find(1),
//            'open' => $open
//        ]);
//    }
//
//
//    /**
//     * @Route("/halloween2021_game_play", name="halloween_game_play")
//     */
//    public function halloween_game_play(UsersRepository $usersRepository,
//                                     AnswersRepository $answersRepository,
//                                     QuestionsRepository $questionsRepository,
//                                     Request $request,
//                                     PollsRepository $pollsRepository,
//                                     ParticipationsRepository $participationsRepository): Response
//    {
//
//        $participationDate = new \DateTime();
//        $entityManager = $this->getDoctrine()->getManager();
//        if($request->isMethod('post'))
//        {
//
//            $participation = $participationsRepository->findOneBy (['User' => $this->getUser(),'Poll' => $pollsRepository->find(2)]);
//
//            $pollRepo = $entityManager->getRepository(Polls::class);
//            $participation->getPoll();
//
//            $poll = $pollsRepository->find(1);
//
//            $questions = $poll->getQuestions();
//
//            $result = $request->request;
//            $totalPoints = 0;
//            $heureValidation = new \DateTime();
//            foreach ($result as $q => $r)
//           {
//                // Choix pour la première question
//                $questionOne = $questions->get($q);
//                $answers = $answersRepository->find($r);
//                $totalPoints += $answers->getAnswerValue();
//                $choice = new Choices();
//                $choice->setQuestion($questionOne);
//                $choice->addAnswer($answers);
//
//                $entityManager->persist($choice);
//                $participation->addChoice($choice);
//                $entityManager->flush();
//            }
//            $participation->setScore($totalPoints);
//            $participation->setDateValidation($heureValidation);
//            $dateDiff = $heureValidation->diff($participation->getCreatedAt());
//            $participation->setDelta($dateDiff->s);
//            $entityManager->persist($participation);
//            $entityManager->flush();
//
//
//            $this->addFlash('success', 'merci de votre participation, vous avez eu ' . $totalPoints . '/5');
//            return $this->redirectToRoute('home');
//
//        }
//
//
//        // On verifie que le questionnaire est ouvert !
//        if ($participationDate >= $pollsRepository->find(1)->getOpenAt() && $participationDate <= $pollsRepository->find(1)->getClosedAt())
//        {
//            // On verifie que le joueur n'a pas déjà joué !
//            if ($participationsRepository->findOneBy(["User" => $this->getUser(),'Poll' => $pollsRepository->find(1)]) !== null)
//            {
//                $this->addFlash('danger', 'Vous avez déjà participé au quizz !!');
//                return $this->redirectToRoute('home');
//            }
//
//            $participation = new Participations();
//            $participation->setCreatedAt(new \DateTime());
//            $pollRepo = $entityManager->getRepository(Polls::class);
//            $poll = $pollsRepository->find(1);
//            $participation->setUser($this->getUser());
//            $participation->setPoll($poll);
//            $entityManager->persist($participation);
//            $entityManager->flush(); // Nous devons flusher une premiére fois pour avoir un identifiant pour la participation
//
//            $debut = 26;
//            $fin = 55;
//            for ($i = 1; $i <= 5; $i++) {
//                $rand = random_int($debut, 55);
//
//                $a = random_int($debut, $fin);
//                $b = random_int($debut, $fin);
//                while($b == $a )
//                {
//                    $b = random_int($debut, $fin);
//                }
//                $c = random_int($debut, $fin);
//                while($c == $a || $c == $b)
//                {
//                    $c = random_int($debut, $fin);
//                }
//                $d = random_int($debut, $fin);
//                while($d == $a || $d == $b || $d == $c)
//                {
//                    $d = random_int($debut, $fin);
//                }
//                $e = random_int($debut, $fin);
//                while($e == $a || $e == $b || $e == $c || $e == $d)
//                {
//                    $e = random_int($debut, $fin);
//                }
//            }
//
//            $a = $questionsRepository->find(1);
////            $b = $questionsRepository->find($b);
////            $c = $questionsRepository->find($c);
////            $d = $questionsRepository->find($d);
////            $e = $questionsRepository->find($e);
//
//            return $this->render('halloween2021/quiz_game.html.twig', [
//                'form' => [$a, $a, $a, $a, $a],
//                'poll' => $pollsRepository->find(1)
//
//            ]);
//        }
//        $this->addFlash('danger', 'la participation à ce quizz est fermé');
//        return $this->redirectToRoute('halloween_game');
//
//    }
}
