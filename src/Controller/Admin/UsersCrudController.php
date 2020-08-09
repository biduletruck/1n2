<?php

namespace App\Controller\Admin;

use App\Controller\RegistrationController;
use App\Entity\Users;
use App\Form\RegistrationFormType;
use App\Form\UsersType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('username', 'Login BOOST'),
            TextField::new('password', 'Mot de pass'),
            ChoiceField::new('roles', 'Role utilisateur')->setChoices(['ROLE_USER' => 'ROLE_USER','ROLE_ADMIN' => 'ROLE_ADMIN'])->allowMultipleChoices(),

        ];
    }

}
