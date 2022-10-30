<?php

namespace App\Controller\Admin;

use App\Entity\ClassementConcour;
use App\Entity\ConcourPhoto;
use App\Entity\PhotoConcour;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PhotoConcourCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PhotoConcour::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */

    public function configureFields(string $pageName): iterable
    {
//        $image= ImageField::new('imageFile')->setUploadDir('/public/images/thumbnails/')->setLabel('Photo');
//        $imageFile = ImageField::new('imageFile')->setBasePath('images/thumbnails')->setLabel('Photo')->onlyOnDetail();
//
//        ImageField::new('filename', 'File')
//            ->setBasePath('uploads/contact_message')
//            ->setUploadDir('public/uploads/contact_message/');
        $fields = [
            TextField::new('nomparticipant', 'Nom du participant'),
            AssociationField::new('NomConcourPhoto', 'NomConcourPhoto' ),
            ImageField::new('imageFile', 'File')
                ->setBasePath('images/thumbnails')
                ->setUploadDir('/public/images/thumbnails/')
        ];

//        if($pageName == Crud::PAGE_EDIT || $pageName == Crud::PAGE_NEW || $pageName == Crud::PAGE_DETAIL){
//            $fields[] = $image;
//        }else{
//            $fields[] = $imageFile;
//        }

        return $fields;


    }
}
