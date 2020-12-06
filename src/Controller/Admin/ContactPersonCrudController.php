<?php

namespace App\Controller\Admin;

use App\Entity\ContactPerson;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ContactPersonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ContactPerson::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
