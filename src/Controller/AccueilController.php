<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
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

    protected $menu;

    public function __construct(CategorieRepository $cat)
    {
         $this->menu = $cat;
    }

    public function liste_categorie_global(){

        return $this->menu->findAll();
    }


}
