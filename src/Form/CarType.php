<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class CarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

//Ici j'aurais pu effectuer les vérifications dans l'entity
//Il m'a paru plus intuitif(et moins intrusif) de les effectués dans le form

        $builder
            ->add('modele', TextType::class, array(
                'label' => 'Modele de la voiture',
                'attr' => array(
                        'placeholder' => 'Modele de la voiture'
                ),
                'help' => 'Entrez un modele',
                'constraints' => new NotBlank()
            ))
            ->add('releasedate', DateType::class, [
                'label' => 'Date de sortie du véhicule',
                'years' => range(1885, date('Y') +10),
                'input' => 'datetime',
                'help' => 'selectionnez une date valide',
                'constraints' => new NotBlank()
            ])
            ->add('brand', EntityType::class, [
                'label' => 'Choisissez la marque',
                'choice_label' => 'name',
                'class' => Brand::class,
                'expanded' => true,
                'required' => true,
                'help' => 'Choisissez une marque',
                'constraints' => new NotBlank()
            ] )
            ->add('fuel', ChoiceType::class, [
                'label' => 'Energie',
                'choices' => [
                    'Diesel' => 'Diesel',
                    'Essence' => 'Essence',
                    'Hybrid' => 'Hybrid',
                    'Electrique' => 'Eletric'],
                    'expanded' => true,
                    'constraints' => new NotBlank()
            ])
            ->add('door', ChoiceType::class, [
                'label' => 'Portes',
                'choices' => [
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8'],
                    'constraints' => new NotBlank()
            ])
            ->add('etat', ChoiceType::class, [
                'label' => 'Etat du véhicule',
                'choices' => [
                    'Neuf' => 'Neuf',
                    'Occasion' => 'Occasion'],
                    'constraints' => new NotBlank()
            ])
            ->add('prix', IntegerType::class, [
                'label' => 'Determinez un prix',
                'constraints' => new NotBlank()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Car::class,
                          // Nos attributs HTML
                          'attr' => [
                            'novalidate' => 'novalidate',
                        ]           
        ]);
    }
}
