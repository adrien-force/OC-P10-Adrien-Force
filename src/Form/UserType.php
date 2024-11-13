<?php

namespace App\Form;

use App\Entity\User;
use App\Enum\ContractTypeEnum;
use App\Enum\UserTypeEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
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
            ->add('password', PasswordType::class, [
                'label' => 'Password',
            ])
            ->add('contractType', ChoiceType::class, [
                'label' => 'Contract Type',
                'choices' => ContractTypeEnum::cases(),
                'choice_label' => function ($choice) {
                    return $choice->name;
                },
            ])
            ->add('active', ChoiceType::class, [
                'label' => 'Active',
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ],
            ])
            ->add('arrivalAt', DateTimeType::class, [
                'label' => 'Arrival Date',
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