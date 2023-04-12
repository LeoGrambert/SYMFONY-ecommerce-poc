<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'attr' => ['placeholder' => 'John'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a firstname',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Your firstname should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('lastname', TextType::class, [
                'attr' => ['placeholder' => 'Doe'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a lastname',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Your lastname should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'john.doe@protonmail.com'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter an email',
                    ]),
                    new Email([
                        'message' => 'The email "{{ value }}" is not a valid email.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Your email should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'required' => true,
                'first_options'  => [
                    'label' => 'Password', 
                    'attr' => [
                        'placeholder' => '*********'
                    ], 
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                        ]),
                        new Length([
                            'min' => 3,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ]
                ],
                'second_options' => [
                    'label' => 'Repeat Password', 
                    'attr' => [
                        'placeholder' => '*********'
                    ], 
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please repeat your password',
                        ]),
                        new Length([
                            'min' => 3,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ]
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Register',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
