<?php

namespace App\Controller\Admin;

use App\Entity\Cheque21;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class Cheque21CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cheque21::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titleCheque', 'Titre du cheque'),
            TextEditorField::new('descriptionCheque', 'Description'),
            TextField::new('imageCheque', 'Nom de l\' image'),
            BooleanField::new('profile', 'profile ancienneté'),
        ];
    }

}
