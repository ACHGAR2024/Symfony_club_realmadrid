<?php

namespace App\Form;

use App\Entity\Section;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class TeamType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, ['label' => 'Nom de l\'équipe', 'attr' => ['class' => 'form-control']])
            ->add('description', null, ['label' => 'Description de l\'équipe', 'attr' => ['class' => 'form-control']])
            ->add('section', EntityType::class, [
                'class' => Section::class,
                'choice_label' => 'name',
                'label' => 'Section',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('photo', FileType::class, [
                'label' => 'Photo de l\'équipe',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5000K',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader un fichier d\'image valide (JPEG, PNG, GIF)',
                    ])
                ],
                'attr' => ['class' => 'form-control-file'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}