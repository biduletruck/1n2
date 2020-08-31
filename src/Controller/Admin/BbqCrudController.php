<?php

namespace App\Controller\Admin;

use App\Entity\Bbq;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BbqCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bbq::class;
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
