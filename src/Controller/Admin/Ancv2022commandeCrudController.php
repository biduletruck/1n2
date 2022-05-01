<?php

namespace App\Controller\Admin;

use App\Entity\Ancv2022commande;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class Ancv2022commandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ancv2022commande::class;
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
