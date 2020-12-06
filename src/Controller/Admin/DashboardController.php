<?php

namespace App\Controller\Admin;

use App\Entity\InfectedPerson;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

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
            ->setTitle('Corona');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            MenuItem::section('Infizierte'),
            MenuItem::linkToCrud('Infizierte Person erfassen', 'fa fa-tags', InfectedPerson::class)
                ->setAction('new'),
            MenuItem::linkToCrud('Infizierte', 'fa fa-tags', InfectedPerson::class),

            MenuItem::section('User')->setPermission('ROLE_ADMIN'),
//            MenuItem::linkToCrud('User hinzufügen', 'fa fa-tags', User::class)
//                ->setAction('new')->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('User', 'fa fa-tags', User::class)->setPermission('ROLE_ADMIN'),
        ];
    }
}
