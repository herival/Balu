<?php

namespace App\Controller;

use App\Repository\MembreRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MembreController extends AbstractController
{
    /**
     * @Route("/membre", name="membre")
     */
    public function index()
    {
        return $this->render('membre/index.html.twig', [
            'controller_name' => 'MembreController',
        ]);
    }

        /**
     * @Route("/membre/liste", name="liste_membre")
     */
    public function liste(MembreRepository $membre)
    {
        
        $liste_membre = $membre->findAll();

        return $this->render('membre/liste.html.twig', [
            'liste_membre' => $liste_membre,
        ]);
    }
}
