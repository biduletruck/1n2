<?php

namespace App\Controller\Admin;

use App\Entity\Matches;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Twig\TemplateWrapper;

class MatchesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Matches::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $HomeResult = IntegerField::new('HomeResult', 'Résultat Home');
        $VisitorResult = IntegerField::new('VisitorResult', 'Résultat Visitor');
        $Victory = AssociationField::new('Victory', 'Victoire');

        $fields = [
            AssociationField::new('Home', 'Home'),
            AssociationField::new('Visitor', 'Visitor'),
            DateTimeField::new('StartTime', 'Date et heure du match'),

        ];

        if ($pageName == Crud::PAGE_EDIT || $pageName == Crud::PAGE_INDEX || $pageName == Crud::PAGE_DETAIL)
        {
            $fields[] = $HomeResult;
            $fields[] = $VisitorResult;
            $fields[] = $Victory;
        }

        return $fields;

//        [
//            AssociationField::new('Home', 'Home'),
//            AssociationField::new('Visitor', 'Visitor'),
//            DateTimeField::new('StartTime', 'Date et heure du match'),
//            IntegerField::new('HomeResult'),
//            IntegerField::new('VisitorResult'),
//            AssociationField::new('Victory', 'Victoire')
//
//
//
//        ];
    }
    
}
