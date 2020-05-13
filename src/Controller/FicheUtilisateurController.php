<?php

namespace App\Controller;

use App\Form\MembreType;
use App\Form\UtilisateurType;
use App\Repository\MembreRepository;
use App\Repository\CommandeRepository;
use App\Repository\DetailcommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface as PasswordEncoder;


class FicheUtilisateurController extends AbstractController
{
    /**
     * @Route("/fiche/utilisateur", name="fiche_utilisateur")
     */
    public function index(MembreRepository $mbr)
    {
        if ($this->getUser()){

            $membre = $mbr->find($this->getUser()->getId());
            return $this->render('fiche_utilisateur/index.html.twig', [
                'membre' => $membre ]);
        }

        return $this->redirectToRoute('accueil');
 
    }
    /**
     * @Route("/fiche/utilisateur/modifier", name="modifier_utilisateur")
     */
    public function modifier(EntityManager $em, Request $request, MembreRepository $membre, PasswordEncoder $up) 
    {

        $membre = $membre->find($this->getUser()->getId());

        $formMembre = $this->createForm(UtilisateurType::class, $membre); 
        $formMembre->handleRequest($request);
        
        if($formMembre->isSubmitted() && $formMembre->isValid()){
            $mdp = $formMembre->get("password")->getData();
         
            if($mdp){
                $mdp = $up->encodePassword($membre, $formMembre->get("password")->getData());
                // $mdp = $up->encodePassword($membre, $mdp);
                $membre->setPassword($mdp);
            }
            $em->persist($membre);
            $em->flush();

            return $this->redirectToRoute("fiche_utilisateur");
        }

        return $this->render("fiche_utilisateur/edition.html.twig", 
        ["formMembre" => $formMembre->createView()]);
    }

     /**
     * @Route("/fiche/utilisateur/commande", name="commande_utilisateur")
     */
    public function liste_commande()
    {
        $liste_commande = $this->getUser();
            //  dd($liste_commande);
        return $this->render('fiche_utilisateur/commandeutilisateur.html.twig', [
            'liste_commande' => $liste_commande,
            ]);
    }

    /**
     * @Route("/fiche/utilisateur/detail_commande/{id}", name="detail_commande_utilisateur", requirements={"id"="\d+"})
     */
    public function liste_detail_commande($id, DetailcommandeRepository $dc, CommandeRepository $com )
    {
        $commande = $com->find($id);

        return $this->render('fiche_utilisateur/listedetailcommande.html.twig', [
            'commande' => $commande,
            ]);
    }

}
