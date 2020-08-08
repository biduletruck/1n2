<?php

namespace App\Controller\Admin;

use App\Entity\Predictions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class PredictionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Predictions::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('Game', 'Match'),
            AssociationField::new('User', 'Utilisateur'),
            DateTimeField::new('CreatedAt', 'Date'),
            IntegerField::new('HomeResult', 'Résultat Home'),
            IntegerField::new('VisitorResult', 'Résultat visitor'),
            AssociationField::new('Predict', 'Victoire'),

        ];
    }

}
