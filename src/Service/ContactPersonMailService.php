<?php

namespace App\Service;

use App\Entity\InfectedPerson;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;
use Twig\Environment;

class ContactPersonMailService
{
    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(EntityManagerInterface $manager, \Swift_Mailer $mailer, Environment $twig)
    {
        $this->manager = $manager;
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function sendMail(InfectedPerson $infectedPerson)
    {
        if ($infectedPerson->getEmail() === null) {
            return;
        }

        $trackingId =  Uuid::v4()->toRfc4122();

        $infectedPerson->setContactTrackingId($trackingId);

        $message = (new \Swift_Message('Kontakverfolgung'))
            ->setFrom('send@example.com')
            ->setTo($infectedPerson->getEmail())
            ->setBody(
                $this->twig->render(
                    'emails/contact_tracking.html.twig',
                    ['infectedPerson' => $infectedPerson]
                ),
                'text/html'
            );

        $this->mailer->send($message);

        $infectedPerson->setMailSendAt(new \DateTime());
        $this->manager->persist($infectedPerson);
        $this->manager->flush();
    }
}