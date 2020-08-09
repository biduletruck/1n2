<?php

namespace App\Controller\Admin;

use App\Entity\Predictions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::DELETE, 'ROLE_SUPERADMIN')
            ->setPermission(Action::NEW, 'ROLE_SUPERADMIN')
            ->setPermission(Action::EDIT, 'ROLE_SUPERADMIN')
            ;

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
