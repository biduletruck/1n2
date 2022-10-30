<?php

namespace App\Controller\Admin;

use App\Entity\ClassementConcour;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ClassementConcourCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ClassementConcour::class;
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
