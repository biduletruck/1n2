<?php

namespace App\Controller\Admin;

use App\Entity\Matches;
use App\Entity\Predictions;
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
//        return parent::index();
        $routeBuilder = $this->get(CrudUrlGenerator::class)->build();

        return $this->redirect($routeBuilder->setController(MatchesCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ce Sitel 3 - Champion League');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linktoRoute('Retour au site', 'fas fa-futbol', 'matches_index');
        yield MenuItem::section('Gestion des utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', 'far fa-id-card', Users::class);
        yield MenuItem::section('Gestion des équipes');
        yield MenuItem::linkToCrud('Les équipes', 'fas fa-users', Teams::class);
        yield MenuItem::linkToCrud('Choix victoires', null, Victories::class);
        yield MenuItem::section('Gestion des matchs');
        yield MenuItem::linkToCrud('Les matchs', null, Matches::class);
        yield MenuItem::linkToCrud('Les pronostiques', null, Predictions::class);
        // yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);
    }
}
