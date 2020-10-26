<?php

namespace App\Controller\Admin;

use App\Entity\HalloweenCheck;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\DateTime;

class HalloweenCheckCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return HalloweenCheck::class;
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
        ];
    }

}
