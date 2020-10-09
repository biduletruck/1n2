<?php

namespace App\Controller\Admin;

use App\Entity\Colis;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ColisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Colis::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $image= ImageField::new('thumbnailFile')->setFormType(VichImageType::class);
        $imageFile = ImageField::new('thumbnail')->setBasePath('/images/thumbnails');
        $fields = [
            TextField::new('nomColis', 'Nom du colis'),
            TextField::new('referenceColis', 'Réference du colis'),
            TextField::new('Titre', 'Titre'),
            TextareaField::new('descriptionColis', 'Description'),
        ];

        if($pageName == Crud::PAGE_EDIT || $pageName == Crud::PAGE_NEW || $pageName == Crud::PAGE_DETAIL){
            $fields[] = $image;
        }else{
            $fields[] = $imageFile;
        }

        return $fields;
    }
}
