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
           ImageField::new('imageName', 'Campaña1')
            ->setBasePath('campania')
            ->setUploadDir('public/campania')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
            //imagen2
            ImageField::new('imageName2', 'Campaña2')
            ->setBasePath('campania')
            ->setUploadDir('public/campania')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
            //imagen3 
            ImageField::new('imageName3', 'Campaña3')
            ->setBasePath('campania')
            ->setUploadDir('public/campania')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
            //imagen4
            ImageField::new('imageName4', 'Campaña4')
            ->setBasePath('campania')
            ->setUploadDir('public/campania')
            ->setUploadedFileNamePattern('[randomhash].[extension]')
            ->setRequired(false),
          
        ];
    }
    
}
/*yield ImageField::new('...')->setUploadDir('assets/images/');   
ImageField::new('image', 'Image')
->onlyOnForms()
->setFormType(VichImageType::class),*/