<?php

namespace App\Controller\Admin;

use App\Entity\Teams;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class TeamsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Teams::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $image= ImageField::new('thumbnailFile')->setFormType(VichImageType::class);
        $imageFile = ImageField::new('thumbnail')->setBasePath('/public/images/thumbnails/')->onlyOnDetail();
        $fields = [
            TextField::new('Name', 'Nom de l\'équipe'),
        ];

        if($pageName == Crud::PAGE_EDIT || $pageName == Crud::PAGE_NEW || $pageName == Crud::PAGE_DETAIL){
            $fields[] = $image;
        }else{
            $fields[] = $imageFile;
        }

        return $fields;
    }

}
