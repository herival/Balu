<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommandeController extends AbstractController
{
    /**
     * @Route("/commande", name="commande")
     */
    public function index()
    {
        return $this->render('commande/index.html.twig', [
            'controller_name' => 'CommandeController',
        ]);
    }

    /**
     * @Route("/commande/liste", name="liste_commande")
     */
    public function liste_commande(CommandeRepository $commande)
    {
        $liste_commande = $commande->findAll();

        // dd($liste_commande);
        return $this->render('commande/liste.html.twig', [
            'liste_commande' => $liste_commande,

            ]);

    }
}
