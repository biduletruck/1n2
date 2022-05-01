<?php

namespace App\Controller\Admin;

use App\Entity\Ancv2022;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class Ancv2022CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ancv2022::class;
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
