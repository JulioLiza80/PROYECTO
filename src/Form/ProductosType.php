<?php

namespace App\Form;

use App\Entity\Categorias;
use App\Entity\Productos;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marca')
            ->add('modelo')
            ->add('precioSinIva')
            ->add('iva')
            ->add('descuento')
            ->add('stock')
            ->add('estado')
            ->add('descripcion')
            ->add('categoria', EntityType::class, [
                'class' => Categorias::class,
                'choice_label' => 'nombre',
            ])
            ->add('imageFile', VichImageType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Productos::class,
        ]);
    }
}
