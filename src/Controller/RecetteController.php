<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Request;

//Pour pouvoir utiliser l'annotation IsGranted
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class RecetteController extends AbstractController
{
    /**
     * @Route("/recette", name="recette")
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(recetteRepository $ar)
    {
        $liste_recette = $ar->findAll();
        return $this->render('recette/index.html.twig', [
            'liste_recette' => $liste_recette,
        ]);
    }

    /**
     * @Route("/recette/nouveau", name="recette_nouveau")
     */
    public function nouveau(EntityManager $em, Request $rq){
        // La classe Request va permettre de récupérer les informations contenues dans les superglobales ($_GET, $_POST,...)

        if($rq->isMethod("POST")){
            // L'objet $rq a une propriété request qui est un objet qui permet de récupérer le $_POST
            // L'objet $rq a une propriété query qui est un objet qui permet de récupérer le $_GET
            $nom = $rq->request->get("name");
            $desc = $rq->request->get("description");
            $recette = new recette;
            $recette->setName($nom);
            $recette->setDescription($desc);
            // la méthode "persist" de l'objet $em permet l'insertion ou la modification en BDD
            $em->persist($recette);

            // pour exécuter les requêtes insertion ou modification en attente, il faut exécuter la méthode
            // "flush" de l'object $em
            $em->flush();

            // redirection vers la route "recette"
            return $this->redirectToRoute("recette");

            // EXO : terminer la méthode pour qu'un nouvel recette soit enregistré en BDD. Ensuite on affiche la liste des recettes
        }
        return $this->render("recette/formulaire.html.twig");
    }

    /**
     * @Route("/recette/new", name="recette_new")
     */
    public function new(Request $rq, EntityManager $em){
        $nvrecette = new recette;
        $formRecette = $this->createForm(recetteType::class, $nvrecette);
        $formRecette->handleRequest($rq);
        if($formRecette->isSubmitted() && $formRecette->isValid()){
            $em->persist($nvrecette);
            $em->flush();
            $this->addFlash("success", "Le nouvel recette a été enregistré");
            return $this->redirectToRoute("recette");
        }
        return $this->render("recette/form.html.twig", [ "form" => $formRecette->createView(), "bouton" => "Enregistrer" ]);
    }

    // créer une route "recette/ajouter/beyoncé" => ça ajouter dans la 
    // BDD un recette beyoncé, et ensuite redirection vers la route "recette"
    /**
     * @Route("/recette/ajouter/{nom}", name="recette_ajouter_name")
     */
    public function ajouterNom(EntityManager $em, $nom){
        $recette = new recette;
        $recette->setName($nom);
        $em->persist($recette);
        $em->flush();
        return $this->redirectToRoute("recette");
    }

    /**
     * @Route("/fiche/recette/{id}", name="recette_fiche", requirements={"id"="\d+"})
     * à cause de requirements, id doit être composé d'1 ou plusieurs chiffres 
     */
    public function fiche(recetteRepository $ar, $id)
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
    public function modifier(Request $rq, EntityManager $em, recetteRepository $ar, $id)
    {
        // Modifier un recette existant
        // récupérer la recette avec son id, l'afficher dans le formulaire et enregistrer les modifications dans la base de données
        $recetteAmodifier = $ar->find($id);
        $formRecette = $this->createForm(recetteType::class, $recetteAmodifier);
        $formRecette->handleRequest($rq);
        if($formRecette->isSubmitted() && $formRecette->isValid()){
            // $em->persist($recetteAmodifier);
            $em->flush();
            $this->addFlash("success", "Les informations de la recette ont été modifiées");
            return $this->redirectToRoute("recette");
        }
        return $this->render("recette/form.html.twig", [ 
            "form" => $formRecette->createView(), 
            "bouton" => "Modifier",
            "titre" => "Modification de la recette n°$id" 
        ]);
    }

    /**
     * @Route("/recette/supprimer/{id}", name="recette_supprimer", requirements={"id"="\d+"})
     */
    public function supprimer(Request $rq, EntityManager $em, recetteRepository $ar, $id)
    {
        $recetteAsupprimer = $ar->find($id);
        $formRecette = $this->createForm(recetteType::class, $recetteAsupprimer);
        $formRecette->handleRequest($rq);
        if($formRecette->isSubmitted() && $formRecette->isValid()){
            $em->remove($recetteAsupprimer);
            $em->flush();
            $this->addFlash("success", "La recette " . $recetteAsupprimer->getName() . " a été supprimé");
            return $this->redirectToRoute("recette");
        }
        $this->addFlash("warning", "<strong>Confirmation</strong> de suppresion");
        return $this->render("recette/form.html.twig", [ 
            "form" => $formRecette->createView(), 
            "bouton" => "Confirmer",
            "titre" => "Suppression de la recette n°$id"
        ]);
    }

}
