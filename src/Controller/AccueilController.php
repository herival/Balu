<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(CategorieRepository $cat)
    {
        $categorie = $cat->findAll();

        return $this->render('accueil/index.html.twig', [
            'categorie' => $categorie,
        ]);
    }
}
