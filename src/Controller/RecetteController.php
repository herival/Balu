<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Entity\Categorie;
use App\Form\RecetteType;
use App\Form\CategorieType;
use App\Repository\RecetteRepository;
use App\Repository\CategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecetteController extends AbstractController
{
    /**
     * @Route("/recette", name="recette")
     */
    public function index(RecetteRepository $ar)
    { 
        $liste_recettes = $ar->findAll();
        return $this->render('recette/index.html.twig', [
            'liste_recettes' => $liste_recettes
        ]);
    }

    /**
     * @Route("/recette/new", name="ajouter_recette")
     * 
     */
    public function ajouter_recette(Request $request, EntityManager $em)
    {
        $nouvelle_recette = new Recette;
        $formRecette = $this->createForm(RecetteType::class, $nouvelle_recette);
        
        $formRecette->handleRequest($request);
        
        if($formRecette->isSubmitted() && $formRecette->isValid()){
            // il faut ajouter une fonction __toString() dans l'entité Categorie pour convertir les valeur en string
            $em->persist($nouvelle_recette);
            $em->flush();
            
            return $this->redirectToRoute("recette");
        }
        
        // dd($nouvelle_recette);
        return $this->render('recette/formRecette.html.twig', 
        ["formRecette" => $formRecette->createView(), 'titre'=> 'Nouvelle Recette', 'bouton'=>'Enregistrer' ]
    );
    }

    /**
     * @Route("/recette/liste", name="liste_recette")
     */
    public function liste_recette(RecetteRepository $recette)
    {
        $liste_recettes = $recette->findAll();

        return $this->render('recette/index.html.twig', [
            'liste_recettes' => $liste_recettes,
        ]);

        
    }
     /**
     * @Route("/fiche/recette/{id}", name="recette_fiche", requirements={"id"="\d+"})
     * à cause de requirements, id doit être composé d'1 ou plusieurs chiffres 
     */
    public function fiche(RecetteRepository $ar, $id)
    {
        $recette = $ar->find($id);
        if(!empty($recette)){
            return $this->render("recette/fiche.html.twig", [ "recette" => $recette ]);
        }
        return $this->redirectToRoute("recette");
       
    }

    /**
     * @Route("/recette/modifier/{id}", name="recette_modifier", requirements={"id"="\d+"})
     */
    public function modifier(Request $rq, EntityManager $em, RecetteRepository $ar, $id)
    {
        // Modifier un recette existant
        // récupérer l'recette avec son id, l'afficher dans le formulaire et enregistrer les modifications dans la base de données
        $recetteAmodifier = $ar->find($id);
        $formRecette = $this->createForm(RecetteType::class, $recetteAmodifier);
        $formRecette->handleRequest($rq);
        if($formRecette->isSubmitted() && $formRecette->isValid()){
            $em->persist($recetteAmodifier);
            $em->flush();
            $this->addFlash("success", "Les informations de l'recette ont été modifiées");
            return $this->redirectToRoute("recette");
        }
        return $this->render("recette/formRecette.html.twig", [ 
            "formRecette" => $formRecette->createView(), 
            "bouton" => "Modifier",
            "titre" => "Modification de l'recette n°$id" 
        ]);
    }

    /**
     * @Route("/recette/supprimer/{id}", name="recette_supprimer", requirements={"id"="\d+"})
     */
    public function supprimer(Request $rq, EntityManager $em, RecetteRepository $recette, $id)
    {
       
        $recette = $recette->find($id);
        $nomrecette = $recette->getTitre();

        $em = $this->getDoctrine()->getManager();
        $em->remove($recette);
        $em->flush();

        $this->addFlash('danger', "L'utilisateur  \"$nomrecette\"  a bien été supprimé!");

        return $this->redirectToRoute("liste_recette");
       
    }
    
    /**
     * @Route("/recette/categorie", name="categorie_recette")
     */
    public function liste_categorie(CategorieRepository $categorie)
    { 
        $liste_categorie = $categorie->findAll();
        return $this->render('recette/categorie.html.twig', [
            'liste_categorie' => $liste_categorie
        ]);
    }


    /**
     * @Route("/recette/categorie/new", name="ajouter_categorie")
     * 
     */
    public function ajouter_categorie(Request $request, EntityManager $em, CategorieRepository $categorie)
    {
        $nouvelle_categorie = new Categorie;

        $formCategorie = $this->createForm(CategorieType::class, $nouvelle_categorie);

        $formCategorie->handleRequest($request);

        if($formCategorie->isSubmitted() && $formCategorie->isValid()){

            $em->persist($nouvelle_categorie);
            $em->flush();

            return $this->redirectToRoute("categorie_recette");
        }

        return $this->render('recette/formCategorie.html.twig', 
        ["formCategorie" => $formCategorie->createView(), 'titre'=> 'Nouvelle Recette', 'bouton'=>'Enregistrer' ]
    );
    }

    /**
     * @Route("/recette/categorie/supprimer/{id}", name="categorie_supprimer", requirements={"id"="\d+"})
     */
    public function supprimer_categorie(Request $rq, EntityManager $em, CategorieRepository $categorie, $id)
    {
       
        $categorie_supprimer = $categorie->find($id);
        $nomcategorie = $categorie_supprimer->getCategorie();
        // dd($nomcategorie);

        $em = $this->getDoctrine()->getManager();
        $em->remove($categorie_supprimer);
        $em->flush();

        $this->addFlash('danger', "L'utilisateur  \"$nomcategorie\"  a bien été supprimé!");

        return $this->redirectToRoute("categorie_recette");
       
    }

    /**
     * @Route("/recette/categorie/modifier/{id}", name="categorie_modifier", requirements={"id"="\d+"})
     */
    public function modifier_categorie(Request $rq, EntityManager $em, CategorieRepository $categorie, $id)
    {
        $categorie_modifier = $categorie->find($id);
        $formCategorie = $this->createForm(CategorieType::class, $categorie_modifier);
        $formCategorie->handleRequest($rq);
        if($formCategorie->isSubmitted() && $formCategorie->isValid()){
            // $em->persist($categorie_modifier);
            $em->flush();
            $this->addFlash("success", "La catégorie à bien été modifié");
            return $this->redirectToRoute("categorie_recette");
        }
        return $this->render("recette/formCategorie.html.twig", [ 
            "formCategorie" => $formCategorie->createView(), 
            "bouton" => "Modifier",
            "titre" => "Modification de la catégorie n°$id" 
        ]);
    }


}
