<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SignUpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('lastname',
                null,
                [
                    'required' => true,
                ])
            ->add('firstname',
                null,
                [
                    'required' => true,
                ])
            ->add('email',
                null,
                [
                    'required' => true,
                ])
            ->add('password',
                null,
                [
                    'required' => true,
                ])
            ->add('confirmPassword',
                null,
                [
                    'required' => true,
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
