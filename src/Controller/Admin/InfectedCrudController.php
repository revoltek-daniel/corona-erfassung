<?php

namespace App\Controller\Admin;

use App\Entity\InfectedPerson;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class InfectedCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return InfectedPerson::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
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
        ];
    }
}
