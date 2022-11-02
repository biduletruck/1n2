<?php

namespace App\Controller\Admin;

use App\Entity\CPConcoursPhotos;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CPConcoursPhotosCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CPConcoursPhotos::class;
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
