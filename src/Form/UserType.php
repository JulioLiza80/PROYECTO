<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            //    ->add('roles')
            // ->add('password')
            // ->add('newPassword', PasswordType::class, [
            //     'required' => false,
            //     'label' => 'Nueva contraseña',
            //     'mapped' => false, // No se mapea al objeto, solo para validación
            // ])
            // ->add('repeatPassword', PasswordType::class, [
            //     'required' => false,
            //     'label' => 'Repetir nueva contraseña',
            //     'mapped' => false, // No se mapea al objeto, solo para validación
            // ])
            ->add('nombre')
            ->add('apellido1')
            ->add('apellido2')
            //    ->add('isVerified')
            ->add('direccion')
            ->add('ciudad')
            ->add('cp')
            ->add('documentFile', VichFileType::class, [
                'required' => false,
                'label' => 'Subir documento',
                'delete_label' => 'Eliminar documentos',
            ])
           
            
            /*    ->add('updatedAt', null, [
                'widget' => 'single_text',
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
