<?php

namespace App\Form;

use App\Entity\Membre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('email', EmailType::class)
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
        ->add('cp', IntegerType::class)
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
