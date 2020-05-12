<?php

namespace App\Controller;


use App\Form\MembreType;
use App\Form\RegistrationFormType;
use App\Repository\MembreRepository;
use App\Repository\CommandeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface as PasswordEncoder;

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
        // $liste_membre = $membre->findBy(array('roles'=> [] ));

        return $this->render('membre/liste.html.twig', [
            'liste_membre' => $liste_membre,
        ]);
    }
    /**
     * @Route("/membre/modifier/{id}", name="modifier_membre")
     */
    public function modifier(EntityManager $em, Request $request, $id, MembreRepository $membre, PasswordEncoder $up) 
    {

        $membre = $membre->find($id);

        $formMembre = $this->createForm(MembreType::class, $membre); 
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

            return $this->redirectToRoute("liste_membre");
        }

        return $this->render("membre/edition.html.twig", 
        ["formMembre" => $formMembre->createView(), "membre" => $membre]);
    }
    /**
     * @Route("/membre/supprimer/{id}", name="supprimer_membre")
     */
    public function supprimer(CommandeRepository $com, EntityManager $em, Request $request, $id, MembreRepository $membre)
    {

        $membre = $membre->find($id);
        $pseudo = $membre->getPseudo();
        $commande = $com->findByMembre($id);
        if(!$commande){
            $em = $this->getDoctrine()->getManager();
            $em->remove($membre);
            $em->flush();
    
            $this->addFlash('success', "L'utilisateur  \"$pseudo\"  a bien été supprimé!");
        } else {
            $this->addFlash('danger', "Le membre  \"$pseudo\" ne peut pas être supprimé car il a un ou des commande(s) en cours");
        }
        


        return $this->redirectToRoute("liste_membre");
    }

    /**
     * @Route("/membre/fiche/{id}", name="fiche_membre")
     */
    public function fiche_membre($id, MembreRepository $membre)
    {
        $membre = $membre->find($id);

        return $this->render('membre/fiche.html.twig', [
            'membre' => $membre,
        ]);
    }

    /**
     * @Route("/membre/liste_admin", name="liste_membre_admin")
     */
    public function liste_membre_admin(MembreRepository $membre)
    {
        $liste_membre = $membre->findByRoles('["ROLE_ADMIN"]');

        return $this->render('membre/liste.html.twig', [
            'liste_membre' => $liste_membre,
        ]);
    }

    /**
     * @Route("/admin/membre/liste_membre", name="liste_membre_membre")
     */
    public function liste_membre_membre(MembreRepository $membre)
    {
        $liste_membre = $membre->findByRoles('[]');

        return $this->render('membre/liste.html.twig', [
            'liste_membre' => $liste_membre,
        ]);
    }

    /**
     * @Route("/admin/membre/membre_recherche", name="recherche_membre_admin")
     */
    public function recherche_membre_admin(Request $request, MembreRepository $membre)
    {
        $motRecherche = $request->query->get("nom");
        $motRecherche = trim($motRecherche); 

        if($motRecherche){
    
            $liste_membre = $membre->findByNom($motRecherche);
            $liste_prenom = $membre->findByPrenom($motRecherche);
        }
  

        return $this->render('membre/recherchemembrebo.html.twig', [
            'liste_membre' => $liste_membre,
            'liste_prenom'=> $liste_prenom
        ]);
    }


}
