<?php

namespace App\Controller\Admin;

use App\Entity\Package21;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class Package21CrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Package21::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('titlePackage', 'Titre du colis'),
            TextField::new('refPackage', 'Référence du colis'),
            TextEditorField::new('descriptionPackage', 'Description'),
            TextField::new('image', 'Nom de l\' image'),
        ];
    }

}
