<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Detailcommande;
use App\Repository\MembreRepository;
use App\Repository\RecetteRepository;
use App\Repository\CommandeRepository;
use App\Repository\DetailcommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
     * @Route("/admin/commande/liste", name="liste_commande")
     */
    public function liste_commande(CommandeRepository $commande)
    {
        $liste_commande = $commande->findBy([],["id"=>"DESC"]);

        return $this->render('commande/liste.html.twig', [
            'liste_commande' => $liste_commande,
            ]);
    }

    /**
     * @Route("/admin/commande/liste_livre", name="liste_commande_livre")
     */
    public function liste_commande_livre(CommandeRepository $commande)
    {
        $liste_commande = $commande->findByEtat('Livrée');

        return $this->render('commande/liste.html.twig', [
            'liste_commande' => $liste_commande,
            ]);
    }

    /**
     * @Route("/admin/commande/liste_encours", name="liste_commande_encours")
     */
    public function liste_commande_encours(CommandeRepository $commande)
    {
        $liste_commande = $commande->findByEtat('En cours');

        return $this->render('commande/liste.html.twig', [
            'liste_commande' => $liste_commande,
            ]);
    }

    /**
     * @Route("/commande/new", name="nouvelle_commande")
     * @ParamConverter("detail")
     */
    public function nouvelle_commande(SessionInterface $session, RecetteRepository $rec, DetailcommandeRepository $detail, CommandeRepository $commande, MembreRepository $membre, EntityManager $em)
    {
        
        //recuperer le panier en cours
        $panier = $session->get('panier', []); 
        
        $total = 0;
        foreach ($panier as $id => $qtt)
        {
            $recette_pour_total = $rec->find($id);
            $prix = $recette_pour_total->getPrix() * $qtt;
            $total = $total + $prix;
        }

        $nouvelle_commande = new Commande;
        $nouvelle_commande->setMontant($total)
            ->setMembre($this->getUser())
            ->setEtat('En cours');
            $em->persist($nouvelle_commande);
            $em->flush();

            //  recuperer le ID de la dernière commande
            $nv_commande_id = $nouvelle_commande->getId();
            

        foreach ($panier as $key => $quantite)
        {
            $recette = $rec->find($key);
    
            
            $prix = $recette->getPrix() * $quantite;

            $nv_detailcommande = new Detailcommande;
            $nv_detailcommande->setCommande($nouvelle_commande)
                ->setRecette($recette)
                ->setQuantite($quantite)
                ->setPrix($prix); 
            $em->persist($nv_detailcommande);
            $em->flush();
        }
    
        $session->set('panier', []);
        return $this->redirectToRoute("recette");  
    }

    /**
     * @Route("/commande/detail/{id}", name="detail_commande")
     */
    public function detail_commande($id, CommandeRepository $commande, DetailcommandeRepository $detail, RecetteRepository $rec)
    {
        $membre = $commande->find($id);
        $commande_detail = $detail->findByCommande($id);

        

      
        return $this->render('commande/detailcommandeback.html.twig', [
            'membre' => $membre,
            'commande_detail'=> $commande_detail, 

            ]);

    }

    /**
     * @Route("/admin/commande/livrer/{id}", name="admin_commande_livrer", requirements={"id"="\d+"})
     */
    public function admin_commande_livrer(EntityManager $em, CommandeRepository $com, $id)
    {
        $commande_livrer = $com->find($id);
        $commande_livrer->setEtat('Livrée');
        $em->flush();

        return $this->redirectToRoute("liste_commande");

    }

    /**
     * @Route("/admin/commande/nonlivrer/{id}", name="admin_commande_nonlivrer", requirements={"id"="\d+"})
     */
    public function admin_commande_nonlivrer(EntityManager $em, CommandeRepository $com, $id)
    {
        $commande_livrer = $com->find($id);
        $commande_livrer->setEtat('En cours');
        $em->flush();

        return $this->redirectToRoute("liste_commande");

    }
    

}
