<?php

namespace App\Form;

use App\Entity\Chambre;
use App\Entity\Commande;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CommandeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_arrivee', DateType::class, [
                'label' => "Date d'arrivée",
                'widget' => 'single_text'
            ])
            ->add('date_depart', DateType::class, [
                'label' => "Date de départ",
                'widget' => 'single_text'
            ])
            // ->add('prix_total')
            ->add('prenom', TextType::class, [
                'label'=> 'Prénom'
            ])
            ->add('nom', TextType::class, [
                'label'=> 'Nom'
            ])
            ->add('telephone', TextType::class, [
                'label'=> 'Téléphone'
            ])
            ->add('email', TextType::class, [
                'label'=> 'E-mail'
            ])
            // ->add('date_enregistrement')
            ->add('chambre', EntityType::class, [
                'class' => Chambre::class,
                'choice_label' => 'titre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commande::class,
        ]);
    }
}