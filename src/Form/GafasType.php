<?php

namespace App\Form;

use App\Entity\DetallePedido;
use App\Entity\Gafas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class GafasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marca')
            ->add('modelo')
            ->add('descripcion')
            ->add('tipo')
            ->add('aro')
            ->add('puente')
            ->add('talla')
            ->add('varilla')
            ->add('colorMontura')
            ->add('colorLentes')
            ->add('materialMontura')
            ->add('tipoMontura')
            ->add('precio')
            ->add('iva')
            ->add('descuento')
            ->add('stock')
            ->add('destacado')
        /*    ->add('detallePedidos', EntityType::class, [
                'class' => DetallePedido::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])*/
            ->add('imageFile', VichImageType::class)
            ->add('imageFile2', VichImageType::class)
            ->add('imageFile3', VichImageType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gafas::class,
        ]);
    }
}
