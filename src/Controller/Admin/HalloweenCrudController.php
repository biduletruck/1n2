<?php

namespace App\Controller\Admin;

use App\Entity\Halloween;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class HalloweenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Halloween::class;
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
            AssociationField::new('User'),
            DateTimeField::new('createdAt'),
            DateTimeField::new('finishedAt'),
            IntegerField::new('quest1'),
            IntegerField::new('quest2'),
            IntegerField::new('quest3'),
            IntegerField::new('quest4'),
            IntegerField::new('quest5'),
            IntegerField::new('quest6'),
            IntegerField::new('quest7'),
            IntegerField::new('quest8'),
            IntegerField::new('quest9'),
            IntegerField::new('quest10'),

        ];
    }
}
