<?php

namespace App\Form;

use App\Entity\Recette;
use App\Entity\Categorie;
use App\Entity\Souscategorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


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
                        "max" => 250,
                        "maxMessage" => "Le nom de la recette ne doit pas dépasser {{ limit }} caractères"
                    ])
                ],
                 "required" => true
            ])
            ->add('description'
            , TextareaType::class, [ 
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
            ->add('image', FileType::class, [
                'label'=> 'ajoutez une image',
                'data_class' => null,
                "required" => false
            ])
            ->add('preparation', TextareaType::class, [ 
                "label" => "préparation de la recette",
                "constraints" => [
                    new NotBlank([ "message" => "Veuillez entrer la préparation de la recette"]),
                    new Length([
                        "min" => 10,
                        "minMessage" => "La préparation de la recette doit comporter au moins 10 caractères"
                      
                    ])
                ],
                 "required" => true
            ])
            ->add('categorie', EntityType::class, [ 
                    "class" => Categorie::class, 
                    "choice_label" => "categorie" 
                    ]) 
            ->add('souscategorie', EntityType::class, [ 
                "class" => Souscategorie::class, 
                "choice_label" => "souscategorie" 
                ]) 
        
            ->add('vente', null)
            ->add('cuisson', TimeType::class, ["widget" => "single_text",
                                 "label" => "Temps de cuisson",
                                 'attr' => ['class'=> "text-center"]
            ]) 
            ->add('tpspreparation', TimeType::class, ["widget" => "single_text",
                                   "label" => "Temps de preparation",
                                  'attr' => ['class'=> "text-center"]
            ]) 
            ->add('nbrepersonne', null, ["label" => "Nombre de personne"])
            ->add('difficulte', ChoiceType::class, [
                "choices"=> [
                    "Facile"=>"Facile",
                    "Intermediaire"=>"Intermediaire",
                    "Difficile"=>"Difficile",
                    ]
                    
            ])
              
                
            
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
