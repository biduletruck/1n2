<?php

namespace App\Controller\Admin;

use App\Entity\CPParticipation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CPParticipationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CPParticipation::class;
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
