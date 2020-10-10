<?php

namespace App\Controller\Admin;

use App\Entity\Noel;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\DateTime;

class NoelCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Noel::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('User', 'Utilisateur'),
            DateTimeField::new('CreatedAt', 'Date'),
            AssociationField::new('choixColis', 'Colis choisi'),
            AssociationField::new('choixCheque', 'Type de cheque'),
            TextField::new('adresseMail', 'Adresse Email'),
            BooleanField::new('optin', 'Autorisation de contact')
        ];
    }

}
