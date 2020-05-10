<?php

namespace App\Controller;

use App\Repository\MembreRepository;
use App\Repository\RecetteRepository;
use App\Repository\CommandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BackofficeController extends AbstractController
{
    /**
     * @Route("/backoffice", name="backoffice")
     */
    public function index(
        MembreRepository $membre, 
        CommandeRepository $com,
        RecetteRepository $rec
        )
    {
        $liste_membre = $membre->findAll();
        $liste_commande = $com->findDerniereCommande();
        $chiffreAffaire = $com->chiffreAffaire();
        $recette = $rec->findAll();

        // dd($chiffreAffaire[0][1]);

        return $this->render('backoffice/index.html.twig', [
            'membre' => $liste_membre,
            'liste_commande'=> $liste_commande,
            'chiffreAffaire'=> $chiffreAffaire[0][1], 
            'recette'=>$recette
        ]);
    }
}
