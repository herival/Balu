<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
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
            'controller_name' => 'RecetteController',
            'liste_recettes' => $liste_recettes,
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

            $em->persist($nouvelle_recette);
            $em->flush();

            return $this->redirectToRoute("recette");
        }

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

}
