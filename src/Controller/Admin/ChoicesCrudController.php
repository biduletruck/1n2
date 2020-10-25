<?php

namespace App\Controller\Admin;

use App\Entity\Choices;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ChoicesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Choices::class;
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
