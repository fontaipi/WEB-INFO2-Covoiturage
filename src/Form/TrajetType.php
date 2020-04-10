<?php

namespace App\Form;

use App\Entity\Trajet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\User\User;

class TrajetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('places')
            ->add('datetime')
            ->add('lieudepart', EntityType::class, [
                'class' => \App\Entity\Lieu::class,
                'choice_label' => 'nom'
            ])
            ->add('lieuarrive', EntityType::class, [
                'class' => \App\Entity\Lieu::class,
                'choice_label' => 'nom'
            ])
            ->add('conducteur', EntityType::class, [
                // looks for choices from this entity
                'class' => \App\Entity\User::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'username',
            ])
           ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trajet::class,
        ]);
    }
}
