<?php

namespace App\Command;

use App\Entity\Users;
use App\Repository\UsersRepository;
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
    private $usersRepository;
    private $ajout = 0;
    private $exclus = 0;
    private $container;

    public function __construct(EntityManagerInterface $em,
                                UserPasswordEncoderInterface $passwordEncoder,
                                ContainerInterface $container,
                                UsersRepository $usersRepository)
    {
        parent::__construct();

        $this->em = $em;
        $this->container = $container;
        $this->usersRepository = $usersRepository;
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

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    protected function deactiveAllUsers(): void
    {
        $allUsers = $this->usersRepository->findAll();
        foreach ($allUsers as $user)
        {
            if (!in_array('ROLE_ADMIN', $user->getRoles(), true)) {
                $user->setIsActive(false);
            }
            $this->em->persist($user);
        }
        $this->em->flush();
    }

    /**
     * @param $row
     * @throws \Exception
     */
    protected function addNewuser($row): void
    {
        $user = new Users();
        $user
            ->setUsername($row["MATRICULE_RH"])
            ->setPassword($this->asPassword($user, $row["PASSWORD"]))
            ->setRoles(["ROLE_USER"])
            ->setNom($row["NOM_PRENOM"])
            ->setIsActive(true)
            ->setDateEntree(new \DateTime($row["DT_ENTREE"]));
        $this->em->persist($user);

    }


    /**
     * @throws \Exception
     */
    protected function ifUserExist($user, $row)
    {
        /** @var  Users $user */
        if($user !== null)
        {
//            $this->updateEnterDaterUser($user, $row);
            $this->activateUser($user);
        }else{
            $this->addNewuser($row);
        }
    }

    protected function updateEnterDaterUser($user, $row): bool
    {
        /** @var  Users $user */
        $user->setDateEntree(new \DateTime($row["DT_ENTREE"]));
        $this->em->persist($user);

        return true;
    }

    protected function activateUser($user): bool
    {
        /** @var  Users $user */
        $user->setIsActive(true);
        $this->em->persist($user);
        return true;
    }

    /**
     * @throws \League\Csv\InvalidArgument
     * @throws \League\Csv\Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("Importation du fichier des nouveaux utilisateurs");

        $this->deactiveAllUsers();

        $reader = Reader::createFromPath('%kernel.root_dir%/../public/csv/agents_cse.csv', 'r');

        $reader
            ->setDelimiter(';')
            ->setEnclosure('"')
            ->setHeaderOffset(0);

        $io->progressStart(iterator_count($reader));
        foreach ($reader as $row)
        {
            $user = $this->usersRepository->findOneBy(['username' => $row["MATRICULE_RH"]]);
            $this->ifUserExist($user, $row);
            $this->em->flush();
            $io->progressAdvance();
        }



        $io->progressFinish();
        $io->success('Importation du fichier terminé. ' . $this->ajout . ' ajouté et ' . $this->exclus . ' exclus.');

        return Command::SUCCESS;
    }


}
