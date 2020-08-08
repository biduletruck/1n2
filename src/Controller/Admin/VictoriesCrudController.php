<?php

namespace App\Controller\Admin;

use App\Entity\Victories;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VictoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Victories::class;
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
