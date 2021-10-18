<?php

namespace App\Controller\Admin;

use App\Entity\Commande21;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class Commande21CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande21::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('createdAt', 'Ajouté le'),
            AssociationField::new('salarie', 'Nom du salarié')->onlyOnForms(),
            TextField::new('emailSalarie', 'Email salarié'),
            AssociationField::new('package', 'Nom du colis')->onlyOnForms(),
            AssociationField::new('cheque', 'Nom du Cheque')->onlyOnForms(),
        ];
    }

}
