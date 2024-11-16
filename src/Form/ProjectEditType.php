<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Status;
use App\Entity\Tag;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('startAt', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('deadline', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('archived',
                CheckboxType::class,
                [
                    'label' => 'Archive',
                    'required' => false,
                ])
            ->add('tags', EntityType::class, [
                'class' => Tag::class,
                'choice_label' => 'tag',
                'multiple' => true,
                'required' => false,
                'by_reference' => false,
            ])
            ->add('users', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'fullname',
                'multiple' => true,
                'required' => false,
                'by_reference' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
