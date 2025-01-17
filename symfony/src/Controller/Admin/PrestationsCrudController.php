<?php

namespace App\Controller\Admin;

use App\Entity\Prestations;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PrestationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Prestations::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('title');
        yield TextareaField::new('message');
        yield TextareaField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex();

    }
    
}
