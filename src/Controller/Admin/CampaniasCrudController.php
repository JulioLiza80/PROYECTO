<?php

namespace App\Controller\Admin;

use App\Entity\Campanias;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use phpDocumentor\Reflection\Types\Boolean;

class CampaniasCrudController extends AbstractCrudController
{
    
    public static function getEntityFqcn(): string
    {
        return Campanias::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            //imagen1
            BooleanField::new('estado'),
            ImageField::new('imageName', 'Imagen')
            ->setBasePath('campania')
            ->setUploadDir('public/campania')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
            //descripcion
            TextEditorField::new('imageDescription'),
          
        ];
    }
    
}
/*yield ImageField::new('...')->setUploadDir('assets/images/');   
ImageField::new('image', 'Image')
->onlyOnForms()
->setFormType(VichImageType::class),*/