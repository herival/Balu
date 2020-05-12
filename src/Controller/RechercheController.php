<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RechercheController extends AbstractController
{
    /**
     * @Route("/recherche", name="recherche")
     */
    public function recherche_recette(RecetteRepository $rec, Request $request)
    {
        $motRecherche = $request->query->get("mot");
        $motRecherche = trim($motRecherche); 
        $derniere_recette = $rec->findBy([], ["id"=>"DESC"], 3);
     
        if($motRecherche){
            $recette = $rec->findByTitre($motRecherche);

        }
  
        return $this->render('recherche/index.html.twig', [
            'liste_recettes' => $recette,
            'derniere_recette'=> $derniere_recette
        ]);
    }
}
