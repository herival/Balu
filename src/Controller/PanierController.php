<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PanierController extends AbstractController
{
    /**
     * @Route("/panier", name="panier")
     */
    public function index(SessionInterface $session, RecetteRepository $recette)
    {
        
        $panier = $session->get('panier', []);

        $panier_data = [];

        foreach ($panier as $id => $quantite) {
            $panier_data[] = [
                'recette' => $recette->find($id),
                'quantite' => $quantite
            ];
        }

        $total = 0;

        foreach ($panier_data as $couple) {
            $total += $couple['recette']->getPrix() * $couple['quantite'];
        }

        return $this->render('panier/index.html.twig', [
            'panier' => $panier_data,
            'total' => $total
        ]);
    }

    /**
     * @Route("/panier/ajouter/{id}", name="ajout_panier")
     */
    public function ajouter($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []); 
        if (empty($panier[$id])) {
            $panier[$id] = 0;
        }
        
        $panier[$id]++;
        
       
        $session->set('panier', $panier);
        
        // unset($panier[$id]);
        // dd($panier);


        return $this->redirectToRoute('panier');
    }

    /**
     * @Route("/panier/supprimer/{id}", name="suppr_article_panier")
     */
    public function supprimer($id, SessionInterface $session)
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('panier');
    }

}
