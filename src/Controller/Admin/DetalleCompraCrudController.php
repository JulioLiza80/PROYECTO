<?php

namespace App\Controller\Admin;

use App\Entity\DetalleCompra;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;


class DetalleCompraCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DetalleCompra::class;
    }
     //eliminar boton crear y actualizar
     public function configureActions(Actions $actions): Actions
     {
         return $actions
             ->disable(Crud::PAGE_DETAIL, Action::NEW)
             ->disable(Crud::PAGE_DETAIL, Action::EDIT)
             
         ;
     }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            IdField::new('idUsuario.id', 'Id Usuario'),
            IntegerField::new('IdTransaccion'),
            DateField::new('fecha'),
            TextField::new('status'),
            TextField::new('email'),
            NumberField::new('total')
            
        ];
    }

    public function configureCrud(Crud $crud): Crud
{
    return $crud
        ->setEntityLabelInSingular('Compra')
        ->setEntityLabelInPlural('Compras')
        ->setSearchFields(['idUsuario.id', 'email', 'IdTransaccion'])
        ->setDefaultSort(['id' => 'DESC'])
    ;
}
    
}
