<?php

namespace App\Controller\Admin;

use App\Entity\Garbage;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class GarbageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Garbage::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            BooleanField::new('isActive')->setLabel('En Service'),
            AssociationField::new('type'),
  
        ];
    }
}
