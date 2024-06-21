<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Prénom *'
            ])
            ->add('surname', TextType::class, [
                'label' => 'Nom *'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email *'
            ])
            ->add('need', ChoiceType::class, [
                'label' => 'Veuillez spécifier votre besoin *',
                'choices' => [
                    'Demande d\'informations' => 'Demande d\'informations',
                    'Réclamation' => 'Réclamation',
                    'Question' => 'Question',
                    'Autre' => 'Autre',
                ]
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message *'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}