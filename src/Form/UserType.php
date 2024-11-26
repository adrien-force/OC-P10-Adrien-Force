<?php

namespace App\Form;

use App\Entity\User;
use App\Enum\ContractTypeEnum;
use App\Validator\Constraints\PasswordConstraint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'First Name',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Last Name',
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
            ])
            ->add('password',
                RepeatedType::class,
                [
                    'type' => PasswordType::class,
                    'invalid_message' => 'Les deux mots de passe doivent être identiques.',
                    'options' => ['attr' => ['class' => 'password-field']],
                    'required' => true,
                    'first_options'  => [
                        'label' => 'Mot de passe',
                        'constraints' => [new PasswordConstraint()],
                    ],
                    'second_options' => ['label' => 'Comfirmer le mot de passe'],
                ])
            ->add('contractType', ChoiceType::class, [
                'label' => 'Contract Type',
                'choices' => ContractTypeEnum::cases(),
                'choice_label' => function ($choice) {
                    return $choice->name;
                },
            ])
            ->add(
                'roles', ChoiceType::class, [
                    'label' => 'Roles',
                    'choices' => [
                        'Admin' => 'ROLE_ADMIN',
                        'User' => 'ROLE_USER',
                    ],
                    'multiple' => false,
                    'expanded' => false,
                    'mapped' => false,
                ]
            )
            ->add('active', ChoiceType::class, [
                'label' => 'Active',
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ],
            ])
            ->add('arrivalAt', DateType::class, [
                'label' => 'Arrival Date',
            ])
            ->add('useTwoFactorAuth', ChoiceType::class, [
                'label' => 'Use Two Factor Auth',
                'choices' => [
                    'Oui' => true,
                    'Non' => false,
                ],
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