<?php

namespace App\Controller;

use App\Repository\MembreRepository;
use App\Repository\RecetteRepository;
use App\Repository\CommandeRepository;
use App\Repository\CommentaireRepository;
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
        RecetteRepository $rec,
        CommentaireRepository $comment
        )
    {
        $liste_membre = $membre->findAll();
        $liste_commande = $com->findBy([], ['id' => 'DESC'],7);
        $chiffreAffaire = $com->chiffreAffaire();
        $recette = $rec->findAll();
        $commentaire = $comment->findBy([], ['id' => 'DESC'],5);
    


        // dd($chiffreAffaire[0][1]);

        return $this->render('backoffice/index.html.twig', [
            'membre' => $liste_membre,
            'liste_commande'=> $liste_commande,
            'chiffreAffaire'=> $chiffreAffaire[0][1], 
            'recette'=>$recette, 
            'commentaire'=>$commentaire
        ]);
    }
}
