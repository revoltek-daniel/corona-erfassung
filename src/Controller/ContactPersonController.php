<?php

namespace App\Controller;

use App\Entity\ContactPerson;
use App\Entity\InfectedPerson;
use App\Form\ContactPersonType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact/person")
 */
class ContactPersonController extends AbstractController
{
    /**
     * @Route("/new/{contactTrackingId}", name="contact_person_new", methods={"GET","POST"})
     *
     */
    public function new(Request $request, InfectedPerson $infectedPerson): Response
    {
        $contactPerson = new ContactPerson();
        $form = $this->createForm(ContactPersonType::class, $contactPerson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contactPerson);
            $entityManager->flush();

            return $this->redirectToRoute('contact_person_success');
        }

        return $this->render('contact_person/new.html.twig', [
            'contact_person' => $contactPerson,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/success", name="contact_person_success")
     */
    public function success()
    {
        return $this->render('contact_person/success.html.twig');
    }
}
