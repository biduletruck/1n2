<?php

namespace App\Controller\Admin;

use App\Entity\CPImages;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CPImagesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return CPImages::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('NonParticipant'),
            TextField::new('image'),
            AssociationField::new('ConcoursPhotos'),
        ];
    }

}
