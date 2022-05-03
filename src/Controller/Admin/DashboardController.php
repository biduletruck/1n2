<?php

namespace App\Controller\Admin;

use App\Entity\Answers;
use App\Entity\Bbq;
use App\Entity\BbqEvent;
use App\Entity\Cheque21;
use App\Entity\Cheques;
use App\Entity\Choices;
use App\Entity\Colis;
use App\Entity\Commande21;
use App\Entity\Halloween;
use App\Entity\HalloweenCheck;
use App\Entity\Matches;
use App\Entity\Noel;
use App\Entity\Package21;
use App\Entity\Polls;
use App\Entity\Predictions;
use App\Entity\Questions;
use App\Entity\Teams;
use App\Entity\Users;
use App\Entity\Victories;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
//        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(HalloweenCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ce Sitel 3');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linktoRoute('Retour au site', 'fas fa-futbol', 'home');
        yield MenuItem::section('Gestion des utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', 'far fa-id-card', Users::class)->setPermission('ROLE_ADMIN');
//        yield MenuItem::section('Gestion des équipes');
//        yield MenuItem::linkToCrud('Les équipes', 'fas fa-users', Teams::class);
//        yield MenuItem::linkToCrud('Choix victoires', null, Victories::class)->setPermission('ROLE_SUPERADMIN');
//        yield MenuItem::section('Gestion des matchs');
//        yield MenuItem::linkToCrud('Les matchs', null, Matches::class);
//        yield MenuItem::linkToCrud('Les pronostiques', null, Predictions::class);
//         yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);
//        yield MenuItem::section('Evenement BBQ CeSitel3');
//        yield MenuItem::linkToCrud('Suivi des inscriptions BBQ', null, BbqEvent::class);
        yield MenuItem::section('Noel 2020');
        yield MenuItem::linkToCrud('Colis de noel', null, Colis::class);
        yield MenuItem::linkToCrud('Cheque de noel', null, Cheques::class);
        yield MenuItem::linkToCrud('Listing de Noel', null, Noel::class);
        // muenu questionnaire
        yield MenuItem::section('Questionnaires');
        yield MenuItem::linkToCrud('Création questionnaire', null, Polls::class);
        yield MenuItem::linkToCrud('Questions', null, Questions::class);
        yield MenuItem::linkToCrud('Reponses', null, Answers::class);
        // yield MenuItem::linkToCrud('Liste des réponses', null, Choices::class);
//         Menu Halloween
//        yield MenuItem::linkToCrud('Listing des participations', null, HalloweenCheck::class);
//        yield MenuItem::linkToCrud('Listing des quiz', null, Halloween::class);
        yield MenuItem::section('Commandes de Noel 2021');
        yield MenuItem::linkToCrud('Colis de noel', null, Package21::class);
        yield MenuItem::linkToCrud('Cheque de noel', null, Cheque21::class);
        yield MenuItem::linkToCrud('Listing de Noel', null, Commande21::class);
    }
}
