<?php

namespace App\Controller\Admin;

use App\Entity\Predictions;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PredictionsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Predictions::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

        ];
    }

}
