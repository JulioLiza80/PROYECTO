<?php

namespace App\Form;

use App\Entity\DetalleCompra;
use App\Entity\DetallePedido;
use App\Entity\Pedidos;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PedidosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('direccion')
            ->add('ciudad')
            ->add('cp')
            ->add('precio')
            ->add('idUsuarioPedidos', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('idCompra', EntityType::class, [
                'class' => DetalleCompra::class,
                'choice_label' => 'id',
            ])
            ->add('detallePedido', EntityType::class, [
                'class' => DetallePedido::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pedidos::class,
        ]);
    }
}
