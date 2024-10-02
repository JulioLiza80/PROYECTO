<?php

namespace App\Form;

use App\Entity\DetallePedido;
use App\Entity\Gafas;
use App\Entity\Lentillas;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetallePedidoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cantidad')
            ->add('precio')
            ->add('idGafas', EntityType::class, [
                'class' => Gafas::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('idLentillas', EntityType::class, [
                'class' => Lentillas::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DetallePedido::class,
        ]);
    }
}
