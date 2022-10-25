<?php

namespace App\Command;

use App\Entity\Answers;
use App\Entity\Polls;
use App\Entity\Questions;
use App\Entity\Users;
use App\Repository\PollsRepository;
use App\Repository\QuestionsRepository;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PollImportCommand extends Command
{
    protected static $defaultName = 'pollImport';

    private $em;
    private $questionsRepository;
    private $pollsRepository;
    private $poll;
    private $newQuestion;


    private $container;

    public function __construct(EntityManagerInterface $em, ContainerInterface $container, PollsRepository $pollsRepository, QuestionsRepository $questionsRepository)
    {
        parent::__construct();

        $this->em = $em;
        $this->questionsRepository = $questionsRepository;
        $this->pollsRepository = $pollsRepository;

        $this->container = $container;

    }

    protected function configure()
    {
        $this
            ->setDescription('Créer un nouveau questionnaire et importer ses questions')
            ->setName('Questionnaire Import')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("Importation du fichier des nouveaux utilisateurs");

        $reader_poll = Reader::createFromPath('%kernel.root_dir%/../public/csv/poll.csv', 'r');
        $reader_questions = Reader::createFromPath('%kernel.root_dir%/../public/csv/questions.csv', 'r');
        $reader_answer = Reader::createFromPath('%kernel.root_dir%/../public/csv/answer.csv', 'r');

        $reader_poll
            ->setDelimiter(';')
            ->setEnclosure('"')
            ->setHeaderOffset(0);


        $io->progressStart(iterator_count($reader_poll));

        $io->section("Création du nouveau questionnaire");
        foreach ($reader_poll as $row)
        {
//            dd($row);
            try {
                $poll = new Polls();
                $poll
                    ->setTitle($row["title"])
                    ->setDuration((int)$row["duration"])
                    ->setDefaultPoll(0)
                    ->setIdentifiant($row['identifiant'])
                    ->setCreatedAt(new \DateTime())
//                    ->setOpenAt(new \DateTime($row['open_at']))
//                    ->setClosedAt(new \DateTime($row['closed_ad']))
                    ->setConsignes($row['consignes'])
                    ->setDescription($row['descritpion'])

                ;
                $this->em->persist($poll);
                $this->em->flush();

                $this->poll = $this->pollsRepository->findOneBy(["Identifiant" => $row['identifiant'] ]);

//                $this->ajout ++;

            } catch (UniqueConstraintViolationException $e) {
                $errorMessage = $e->getMessage();
                $this->em = $this->container->get('doctrine')->resetManager();
//                $this->exclus ++;
            }
            catch(\Exception $e){
                $errorMessage = $e->getMessage();
                $this->em = $this->container->get('doctrine')->resetManager();
//                $this->exclus ++;
                print($errorMessage);
            }
            $io->progressAdvance();
        }
        $io->progressFinish();


        $reader_questions
            ->setDelimiter(';')
            ->setEnclosure('"')
            ->setHeaderOffset(0);

        $io->progressStart(iterator_count($reader_questions));

        $io->section("Importation des questions");
        foreach ($reader_questions as $row)
        {
//            dd($row);

            try {
                $question = new Questions();
                $question
                    ->setPoll($this->poll)
                    ->setWording("<div>" . $row["wording"] . "</div>")
                    ->setQuestionNumber((int) $row["question_number"])
                    ->setPicture($row["picture"])
                    ->setDifficulty((int) $row["difficulty"])

                ;
                $this->em->persist($question);
                $this->em->flush();
//                $this->ajout ++;

            } catch (UniqueConstraintViolationException $e) {
                $errorMessage = $e->getMessage();
                $this->em = $this->container->get('doctrine')->resetManager();
//                $this->exclus ++;
            }
            catch(\Exception $e){
                $errorMessage = $e->getMessage();
                $this->em = $this->container->get('doctrine')->resetManager();
//                $this->exclus ++;
                print($errorMessage);
            }
            $io->progressAdvance();
        }
        $io->progressFinish();

        $reader_answer
            ->setDelimiter(';')
            ->setEnclosure('"')
            ->setHeaderOffset(0);

        $io->progressStart(iterator_count($reader_answer));

        $io->section("Importation des réponses");
        foreach ($reader_answer as $row)
        {
//            $tmpQuestion = $this->questionsRepository->findOneBy()by(["QuestionNumber" => $row["question_identifiant"]]);

            try {
                $reponse = new Answers();
                $reponse
                    ->setQuestion($this->questionsRepository->findOneBy(["QuestionNumber" => $row["question_identifiant"]]))
                    ->setWording("<div>" . $row["wording"] . "</div>")
                    ->setAnswerNumber((int) $row["answer_number"])
                    ->setAnswerValue((int) $row["answer_value"])

                ;
                $this->em->persist($reponse);
                $this->em->flush();
//                $this->ajout ++;

            } catch (UniqueConstraintViolationException $e) {
                $errorMessage = $e->getMessage();
                $this->em = $this->container->get('doctrine')->resetManager();
//                $this->exclus ++;
            }
            catch(\Exception $e){
                $errorMessage = $e->getMessage();
                $this->em = $this->container->get('doctrine')->resetManager();
//                $this->exclus ++;
                print($errorMessage);
            }
            $io->progressAdvance();
        }

        $io->progressFinish();
        $io->success('Importation du fichier terminé.');

        return Command::SUCCESS;
    }
}