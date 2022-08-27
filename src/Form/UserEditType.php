<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Form\CallbackTransformer;



class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Visiteur' => 'ROLE_USER',
                    'Manager' => 'ROLE_MANAGER',
                    'Admin' => 'ROLE_ADMIN'
                ],
                'multiple' => false,
                'expanded' => true,
                'required' => false
            ])
        ;
                // Data transformer
                $builder->get('roles')
                ->addModelTransformer(new CallbackTransformer(
                    function ($rolesArray) {
                         // transform the array to a string
                         return count($rolesArray)? $rolesArray[0]: null;
                    },
                    function ($rolesString) {
                         // transform the string back to an array
                         return [$rolesString];
                    }
            ));
}
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
                        // Nos attributs HTML
                        'attr' => [
                            'novalidate' => 'novalidate',
                        ]           
        ]);
    }
}