<?php

namespace App\Form;

use App\Entity\Recette;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [ 
                "label" => "Nom de la recette",
                "constraints" => [
                    new NotBlank([ "message" => "Veuillez entrer le nom de la recette"]),
                    new Length([
                        "min" => 2,
                        "minMessage" => "Le nom de la recette doit comporter au moins 2 caractères",
                        "max" => 20,
                        "maxMessage" => "Le nom de la recette ne doit pas dépasser {{ limit }} caractères"
                    ])
                ],
                 "required" => true
            ])
            ->add('description'
            , TextType::class, [ 
                "label" => "description de la recette",
                "constraints" => [
                    new NotBlank([ "message" => "Veuillez entrer la description de la recette"]),
                    new Length([
                        "min" => 10,
                        "minMessage" => "La description de la recette doit comporter au moins 10 caractères",
                        "max" => 500,
                        "maxMessage" => "La description de la recette ne doit pas dépasser {{ limit }} caractères"
                    ])
                ],
                 "required" => true
            ])
            ->add('image', FileType::class, array(
                'label'=> 'ajoutez une image',
                'data_class' => null,
                "required" => false
            ))
            ->add('preparation', TextType::class, [ 
                "label" => "préparation de la recette",
                "constraints" => [
                    new NotBlank([ "message" => "Veuillez entrer la préparation de la recette"]),
                    new Length([
                        "min" => 10,
                        "minMessage" => "La préparation de la recette doit comporter au moins 10 caractères",
                        "max" => 500,
                        "maxMessage" => "La préparation de la recette ne doit pas dépasser {{ limit }} caractères"
                    ])
                ],
                 "required" => true
            ])
            ->add('categorie', EntityType::class, [ "class" => Categorie::class, "choice_label" => "name" ]) 
            ->add('pack_ingredient')
            // ->add('membre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
