<?php

namespace App\Controller\Admin;

use App\Entity\ContactPerson;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ContactPersonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContactPerson::class;
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
            'contacted',
            DateTimeField::new('contactDate'),
            'tested',
        ];
    }
}
