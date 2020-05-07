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
    public function index()
    {
        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecetteController',
        ]);
    }

    /**
     * @Route("/recette/new", name="ajouter_recette")
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

}
