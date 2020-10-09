<?php

namespace App\Controller\Admin;

use App\Entity\Cheques;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ChequesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Cheques::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $image= ImageField::new('thumbnailFile')->setFormType(VichImageType::class);
        $imageFile = ImageField::new('thumbnail')->setBasePath('/images/thumbnails');
        $fields = [
            TextField::new('nomCheque', 'Nom du cheque'),

        ];

        if($pageName == Crud::PAGE_EDIT || $pageName == Crud::PAGE_NEW || $pageName == Crud::PAGE_DETAIL){
            $fields[] = $image;
        }else{
            $fields[] = $imageFile;
        }

        return $fields;
    }

}
