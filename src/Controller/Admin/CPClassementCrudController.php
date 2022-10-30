<?php

namespace App\Controller\Admin;

use App\Entity\CPClassement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CPClassementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CPClassement::class;
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
