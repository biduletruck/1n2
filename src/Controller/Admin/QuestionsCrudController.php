<?php

namespace App\Controller\Admin;

use App\Entity\Questions;
use ContainerCYLpMeo\getFieldCollectionService;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class QuestionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Questions::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('Poll'),
            IntegerField::new('QuestionNumber'),
            TextEditorField::new('Wording'),
            IntegerField::new('Difficulty'),
            TextField::new('Picture')
        ];
    }
}
