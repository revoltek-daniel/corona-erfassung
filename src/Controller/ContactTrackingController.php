<?php

namespace App\Controller;

use App\Controller\Admin\InfectedCrudController;
use App\Entity\InfectedPerson;
use App\Service\ContactPersonMailService;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactTrackingController extends AbstractController
{
    /**
     * @Route("/contact/tracking/{infectedPerson}", name="contact_tracking")
     */
    public function index(ContactPersonMailService $contactPersonMailService, InfectedPerson $infectedPerson, CrudUrlGenerator $crudUrlGenerator): Response
    {
        $contactPersonMailService->sendMail($infectedPerson);

        $url = $crudUrlGenerator
            ->build()
            ->setController(InfectedCrudController::class)
            ->setAction(Action::INDEX);

        return $this->redirect($url);
    }
}
