<?php

namespace App\Controller\Admin;

use App\Entity\ContactPerson;
use App\Entity\InfectedPerson;
use App\Entity\User;
use App\Repository\ContactPersonRepository;
use App\Repository\InfectedRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @var InfectedRepository
     */
    private $infectedRepository;
    /**
     * @var ContactPersonRepository
     */
    private $contactPersonRepository;

    public function __construct(InfectedRepository $infectedRepository, ContactPersonRepository $contactPersonRepository)
    {
        $this->infectedRepository = $infectedRepository;
        $this->contactPersonRepository = $contactPersonRepository;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $infected = $this->infectedRepository->countInfected();

        $infectedThisWeek = $this->infectedRepository->countInfectedForCurrentWeek();

        $contactPersons = $this->contactPersonRepository->countContacts();

        return $this->render('dashboard/welcome.html.twig', [
            'infected' => $infected,
            'infectedThisWeek' => $infectedThisWeek,
            'contactPersons' => $contactPersons,
            'dashboard_controller_filepath' => (new \ReflectionClass(static::class))->getFileName(),
            'dashboard_controller_class' => (new \ReflectionClass(static::class))->getShortName(),
        ]);
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

            MenuItem::section('Kontaktpersonen'),
            MenuItem::linkToCrud('Kontaktpersonen', 'fa fa-tags', ContactPerson::class),

            MenuItem::section('User')->setPermission('ROLE_ADMIN'),
//            MenuItem::linkToCrud('User hinzufügen', 'fa fa-tags', User::class)
//                ->setAction('new')->setPermission('ROLE_ADMIN'),
            MenuItem::linkToCrud('User', 'fa fa-tags', User::class)->setPermission('ROLE_ADMIN'),
        ];
    }

}
