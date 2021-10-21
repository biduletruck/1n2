<?php

namespace App\Command;

use App\Entity\Users;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserImportCommand extends Command
{
    protected static $defaultName = 'userImport';

    private $em;
    private $passwordEncoder;
    private $ajout = 0;
    private $exclus = 0;
    private $container;

    public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $passwordEncoder, ContainerInterface $container)
    {
        parent::__construct();

        $this->em = $em;
        $this->container = $container;
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function configure()
    {
        $this
            ->setDescription('Importer des utilisateurs')
            ->setName('Users Import')
        ;
    }

    protected function asPassword($user, $password = "Sitel@2020" )
    {
        return $this->passwordEncoder->encodePassword(
            $user,
            $password
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("Importation du fichier des nouveaux utilisateurs");

        $reader = Reader::createFromPath('%kernel.root_dir%/../public/csv/agents_cse.csv', 'r');

        $reader
            ->setDelimiter(';')
            ->setEnclosure('"')
            ->setHeaderOffset(0);

        $io->progressStart(iterator_count($reader));
        foreach ($reader as $row)
        {
            try {
                $user = new Users();
                $user
                    ->setUsername($row["MATRICULE_RH"])
                    ->setPassword($this->asPassword($user,$row["PASSWORD"] ))
                    ->setRoles(["ROLE_USER"])
                    ->setNom($row["NOM_PRENOM"])
                    ->setDateEntree(new \DateTime($row["DT_ENTREE"]))
                ;
                $this->em->persist($user);
                $this->em->flush();
                $this->ajout ++;

            } catch (UniqueConstraintViolationException $e) {
                $errorMessage = $e->getMessage();
                $this->em = $this->container->get('doctrine')->resetManager();
                $this->exclus ++;
            }
            catch(\Exception $e){
                $errorMessage = $e->getMessage();
                $this->em = $this->container->get('doctrine')->resetManager();
                $this->exclus ++;
                print($errorMessage);
            }
            $io->progressAdvance();
        }



        $io->progressFinish();
        $io->success('Importation du fichier terminé. ' . $this->ajout . ' ajouté et ' . $this->exclus . ' exclus.');

        return Command::SUCCESS;
    }
}
