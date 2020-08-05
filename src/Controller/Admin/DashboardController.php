<?php

namespace App\Controller\Admin;

use App\Entity\Matches;
use App\Entity\Predictions;
use App\Entity\Teams;
use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
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
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Cestitel3 1n2');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Gestion des utilisateurs');
        yield MenuItem::linkToCrud('Utilisateurs', null, Users::class);
        yield MenuItem::section('Gestion des équipes');
        yield MenuItem::linkToCrud('Les équipes', null, Teams::class);
        yield MenuItem::section('Gestion des matchs');
        yield MenuItem::linkToCrud('Les matchs', null, Matches::class);
        yield MenuItem::linkToCrud('Les pronostiques', null, Predictions::class);
        // yield MenuItem::linkToCrud('The Label', 'icon class', EntityClass::class);
    }
}
