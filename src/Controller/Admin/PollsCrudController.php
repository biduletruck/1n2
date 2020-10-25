<?php

namespace App\Controller\Admin;

use App\Entity\Polls;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PollsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Polls::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('Id'),
            TextField::new('Title'),
            DateTimeField::new('CreatedAt'),
            IntegerField::new('Duration'),
        ];
    }
}
