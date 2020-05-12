<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class MembreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class)
            ->add('email', )
            ->add('roles' , ChoiceType::class, [ 
                "choices" => [ 
                    "Membre" => "ROLE_USER", 
                    "Contributeur" => "ROLE_CONTRIBUTEUR",
                    "Administrateur" => "ROLE_ADMIN",
                    "Développeur" => "ROLE_DEV"
                ],
                "multiple"=> true,
                "label" =>"Rôle"
            ])
            ->add('password', PasswordType::class, [
                "mapped"=> false, 
                "required"=>false
                // "constraints" => [
                //     new Regex([ 
                //         "pattern"=> "/^(?=.{4,}$)(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$/",
                //         "message"=> "Le mot de passe doit comporter au moins une minuscule, une majuscule, un chiffre et un caractère spécial"
                //     ])
                // ]
                ]
            
            )
            ->add('Pseudo')
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('cp')
            ->add('ville')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Membre::class,
        ]);
    }
}
