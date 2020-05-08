<?php

namespace App\Controller;

use App\Repository\MembreRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BackofficeController extends AbstractController
{
    /**
     * @Route("/backoffice", name="backoffice")
     */
    public function index(MembreRepository $membre)
    {
        $liste_membre = $membre->findAll();

        return $this->render('backoffice/index.html.twig', [
            'membre' => $liste_membre,
        ]);
    }
}
