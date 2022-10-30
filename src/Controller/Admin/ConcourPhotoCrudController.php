<?php

namespace App\Controller\Admin;

use App\Entity\ConcourPhoto;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ConcourPhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ConcourPhoto::class;
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
