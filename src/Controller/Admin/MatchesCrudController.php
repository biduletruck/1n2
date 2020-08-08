<?php

namespace App\Controller\Admin;

use App\Entity\Matches;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Twig\TemplateWrapper;

class MatchesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Matches::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('Home', 'Home'),
            AssociationField::new('Visitor', 'Visitor'),
            DateTimeField::new('StartTime', 'Date et heure du match'),
            AssociationField::new('Victory', 'Victoire')



        ];
    }
    
}
