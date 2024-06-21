<?php

namespace App\Form;

use App\Entity\Team;
use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Prénom'
            ])
            ->add('lastName', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom'
            ])
            ->add('birthDate', null, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
                'label' => 'Date de naissance'
            ])
            ->add('post', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Poste'
            ])
            ->add('numero', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'N°'
            ])
            ->add('contratActuel', null, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
                'label' => 'Contrat'
            ])
            ->add('salaire', NumberType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Salaire (en €)'
            ])

            ->add('email', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Email'
            ])
            ->add('phone', null, [
                'attr' => ['class' => 'form-control', 'pattern' => '^[0-9]{10}$', 'title' => '10 chiffres'],
                'label' => 'Téléphone'
            ])
            ->add('team', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
                'label' => 'Équipe'
            ])
            ->add('photo', FileType::class, [
                'label' => 'Photo membre',
                'mapped' => false, // Indique que ce champ n'est pas lié directement à une propriété de l'entité
                'required' => false, // Le champ n'est pas requis
                'constraints' => [
                    new File([
                        'maxSize' => '5000k', // Limite de taille maximale du fichier
                        'mimeTypes' => [ // Types MIME autorisés
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                            'image/webp',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader un fichier d\'image valide (JPEG, PNG, GIF)',
                    ])
                ],
                'attr' => ['class' => 'form-control-file']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}