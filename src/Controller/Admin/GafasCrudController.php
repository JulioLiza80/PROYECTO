<?php

namespace App\Controller\Admin;

use App\Entity\Gafas;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;  // Añadir esta línea
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class GafasCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Gafas::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('marca'),
            TextField::new('modelo'),
            TextEditorField::new('descripcion'),
            TextField::new('tipo'),
            NumberField::new('aro'),
            NumberField::new('puente'),
            NumberField::new('talla'),
            NumberField::new('varilla'),
            TextField::new('colorMontura'),
            TextField::new('colorLentes'),
            TextField::new('materialMontura'),
            TextField::new('tipoMontura'),
            NumberField::new('precio')->setNumDecimals(2),
            NumberField::new('iva'),
            NumberField::new('descuento'),
            NumberField::new('stock'),
            ChoiceField::new('destacado')->setChoices(['No destacado' => 0, 'Destacado' => 1]),
            //imagen1
            ImageField::new('imageName', 'Imagen principal')
                ->setBasePath('images/gafas')
                ->setUploadDir('public/images/gafas')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Gafa')
            ->setEntityLabelInPlural('Gafas')
            ->setSearchFields(['marca', 'modelo', 'id'])
            ->setDefaultSort(['id' => 'DESC']);
    }
}
