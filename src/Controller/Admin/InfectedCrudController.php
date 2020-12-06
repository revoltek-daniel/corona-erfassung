<?php

namespace App\Controller\Admin;

use App\Entity\InfectedPerson;
use App\Form\ContactPersonType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Routing\Annotation\Route;

class InfectedCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InfectedPerson::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('salutation')->setChoices(['Herr' => 'mr', 'Frau' => 'mrs', 'Divers' => 'div']),
            'firstname',
            'lastname',
            TextField::new('street')->hideOnIndex(),
            TextField::new('streetnumber')->hideOnIndex(),
            NumberField::new('zip')->hideOnIndex(),
            TextField::new('city')->hideOnIndex(),
            TelephoneField::new('phone')->hideOnIndex(),
            EmailField::new('email')->hideOnIndex(),
            'quarantineStart',
            'quarantineEnd',
            'positiveTest',
            'inQuarantine',
            'contactsCollected',
            CollectionField::new('contactPersons')
                ->setEntryIsComplex(true)
                ->setEntryType(ContactPersonType::class)
                ->hideOnIndex(),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        $actions = parent::configureActions($actions);

        $actions->setPermission(Action::DELETE, 'ROLE_ADMIN');

        $sendMailAction = Action::new('sendMail', 'Mail versenden', 'fa fa-envelope')
            ->linkToRoute('contact_tracking', function (InfectedPerson $infectedPerson) {
                return ['infectedPerson' => $infectedPerson->getId()];
            });

    $detailAction =  Action::new('detail')->linkToCrudAction('detail');

        $actions->add(Crud::PAGE_DETAIL, $sendMailAction)->add(Crud::PAGE_INDEX, $detailAction);


        return $actions;
    }
}
