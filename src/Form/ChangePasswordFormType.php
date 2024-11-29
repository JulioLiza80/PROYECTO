<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotCompromisedPassword;
use Symfony\Component\Validator\Constraints\PasswordStrength;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'attr' => [
                        'autocomplete' => 'new-password',
                    ],
                ],
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Introduce una contraseña',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'La contraseña debe tener, al menos, {{ limit }} caracteres.',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                        new PasswordStrength(),
                        new NotCompromisedPassword(),
                    ],
                    'label' => 'Nueva contraseña',
                    'label_attr' => [
                        'class' => 'font-semibold', // Clases Tailwind para labels
                    ],
                    'attr' => [
                        'class' => 'ml-2 border border-gray-300 rounded-md p-2',
                    ],
                ],
                'second_options' => [
                    'label' => 'Repite la contraseña',
                    'label_attr' => [
                        'class' => 'font-semibold', // Clases Tailwind para labels
                    ],
                    'attr' => [
                        'class' => 'ml-2 border border-gray-300 rounded-md p-2',
                    ],
                ],
                'invalid_message' => 'Las contraseñas no coinciden.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
