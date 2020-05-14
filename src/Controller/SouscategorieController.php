<?php

namespace App\Controller;

use App\Entity\Souscategorie;
use App\Form\SousCategorieType;
use App\Repository\RecetteRepository;
use App\Repository\SouscategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SouscategorieController extends AbstractController
{
    /**
     * @Route("/admin/souscategorie", name="souscategorie")
     */
    public function index(SouscategorieRepository $sc)
    {
        $liste_souscategorie = $sc->findAll();

        return $this->render('souscategorie/listesscategorie.html.twig', [
            'liste_souscategorie' => $liste_souscategorie
        ]);
    }

    /**
     * @Route("/admin/souscategorie/ajouter", name="ajouter_souscategorie")
     */
    public function ajouter_souscategorie(SouscategorieRepository $sc, Request $request, EntityManager $em)
    {
        $nouvelle_souscategorie = new Souscategorie;

        $formSousCategorie = $this->createForm(SousCategorieType::class, $nouvelle_souscategorie);

        $formSousCategorie->handleRequest($request);

        if($formSousCategorie->isSubmitted() && $formSousCategorie->isValid()){

            $em->persist($nouvelle_souscategorie);
            $em->flush();

            return $this->redirectToRoute("souscategorie");
        }

        return $this->render('souscategorie/ajouter.html.twig', 
        ["formSousCategorie" => $formSousCategorie->createView()]);
    }

    /**
     * @Route("/admin/souscategorie/supprimer/{id}", name="souscategorie_supprimer", requirements={"id"="\d+"})
     */
    public function souscategorie_supprimer(Request $rq, EntityManager $em, SouscategorieRepository $sc, $id, RecetteRepository $rec)
    {
        $verif_categorie = $rec->findBySousCategorie($id);
        $souscategorie_supprimer = $sc->find($id);
        $nomcategorie = $souscategorie_supprimer->getSouscategorie();

        if(!$verif_categorie){

            // dd($nomcategorie);
    
            $em = $this->getDoctrine()->getManager();
            $em->remove($souscategorie_supprimer);
            $em->flush();
    
            $this->addFlash('success', "La sous-categorie \"$nomcategorie\"  a bien été supprimée!");
        } else {
            $this->addFlash('danger', "La sous-catégorie \"$nomcategorie\"  ne peut pas être supprimer, elle est afféctée à une ou plusieurs recettes");

        }

        return $this->redirectToRoute("souscategorie");
       
    }

    /**
     * @Route("/admin/souscategorie/modifier/{id}", name="souscategorie_modifier", requirements={"id"="\d+"})
     */
    public function souscategorie_modifier(Request $rq, EntityManager $em, SouscategorieRepository $sc, $id)
    {

        $souscategorie_modifier = $sc->find($id);
        $formSousCategorie = $this->createForm(SouscategorieType::class, $souscategorie_modifier);
        $formSousCategorie->handleRequest($rq);
        if($formSousCategorie->isSubmitted() && $formSousCategorie->isValid()){
           
            $em->flush();
            $this->addFlash("success", "La sous-catégorie à bien été modifiée");
            return $this->redirectToRoute("souscategorie");
        }
        return $this->render("souscategorie/ajouter.html.twig", [ 
            "formSousCategorie" => $formSousCategorie->createView(), 
            "bouton" => "Modifier",
            "titre" => "Modification de la catégorie n°$id" 
        ]);
    }
}
