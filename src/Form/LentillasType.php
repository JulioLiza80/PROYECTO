<?php

namespace App\Form;

use App\Entity\DetallePedido;
use App\Entity\Lentillas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
class LentillasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marca')
            ->add('descripcion')
            ->add('tipoProducto')
            ->add('frecuencia')
            ->add('tipo')
            ->add('material')
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lentillas::class,
        ]);
    }
}
