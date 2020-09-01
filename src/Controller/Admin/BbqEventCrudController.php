<?php

namespace App\Controller\Admin;

use App\Entity\BbqEvent;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class BbqEventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return BbqEvent::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('salarie'),
            BooleanField::new('present'),
            BooleanField::new('conjoint'),
            IntegerField::new('nombreEnfants'),
            BooleanField::new('roller'),
            BooleanField::new('foot'),
            BooleanField::new('tennis'),
            BooleanField::new('reglement')
        ];
    }

}
