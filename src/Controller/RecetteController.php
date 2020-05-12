<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Entity\Categorie;
use App\Form\RecetteType;
use App\Form\CategorieType;
use App\Entity\PackIngredient;
use App\Form\PackIngredientType;
use App\Repository\RecetteRepository;
use App\Repository\CategorieRepository;
use App\Repository\CommentaireRepository;
use App\Repository\DetailcommandeRepository;
use App\Repository\PackIngredientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RecetteController extends AbstractController
{

    /**
     * @Route("/recette", name="recette")
     */
    public function index(RecetteRepository $ar)
    { 
        $liste_recettes = $ar->findAll();

        
        return $this->render('recette/index.html.twig', [
            'liste_recettes' => $liste_recettes
        ]);
    }
    /**
     * @Route("/recette/pays/{id}", name="recettesdupays")
     */
    public function recettes_par_pays($id, RecetteRepository $RR)
    { 
        $liste_recettes = $RR->findByCategorie($id);


        
        return $this->render('recette/recettesdupays.html.twig', [
            'liste_recettes' => $liste_recettes
        ]);
    }

    /**
     * @Route("/recette/fiche/{id}", name="fiche_recette")
     */
    public function fiche_recette($id, RecetteRepository $ar, CommentaireRepository $comment)
    { 
        
        if($this->getUser()){
            $commentaire_membre = $comment->findByMembre($this->getUser()->getId(), $id);
        } else {
            $commentaire_membre = array();

        }

        $recette = $ar->find($id);


        return $this->render('recette/ficherecette.html.twig', [
            'recette' => $recette,
            'commentaire_membre'=> $commentaire_membre
        ]);
    }
    

    // /**
    //  * @Route("/admin/recette", name="liste_recette_admin")
    //  */
    // public function recette_backoffice(SessionInterface $session, RecetteRepository $ar, CategorieRepository $cat)
    // { 
    //     $categorie = $cat->findAll();
    //     $liste_recettes = $ar->findAll();

    //     $id_recette_modif = $session->set('id_recette_modif', []);

    //     return $this->render('recette/indexbackoffice.html.twig', [
    //         'liste_recettes' => $liste_recettes,
    //         'categorie'=> $categorie
    //     ]);
    // }

       /**
     * @Route("/admin/recette/liste", name="admin_liste_recette")
     */
    public function liste_recette_backoffice(RecetteRepository $recette, CategorieRepository $cat, SessionInterface $session)
    {
        $liste_recettes = $recette->findAll();
        $categorie = $cat->findAll();

        $id_recette_modif = $session->set('id_recette_modif', []);


        return $this->render('recette/indexbackoffice.html.twig', [
            'liste_recettes' => $liste_recettes,
            'categorie'=> $categorie,
        ]);

        
    }

    /**
     * @Route("/admin/recette/categorie/{id}", name="recette_backoffice_recherche")
     */
    public function recette_backoffice_recherche($id, SessionInterface $session, RecetteRepository $ar, CategorieRepository $cat)
    { 
        $liste_recettes = $ar->findByCategorie($id);
        $categorie = $cat->findAll();


        return $this->render('recette/indexbackoffice.html.twig', [
            'liste_recettes' => $liste_recettes, 
            'categorie'=> $categorie,
            'id'=>$id
        ]);
    }

    /**
     * @Route("/recette/new", name="ajouter_recette")
     * 
     */
    public function ajouter_recette(SessionInterface $session, Request $request, EntityManager $em)
    {
        $id_recette_encours = $session->get('id_recette_encours', []);

        $nouvelle_recette = new Recette;
        $formRecette = $this->createForm(RecetteType::class, $nouvelle_recette);
        
        $formRecette->handleRequest($request);
        
        if($formRecette->isSubmitted() && $formRecette->isValid()){
            // il faut ajouter une fonction __toString() dans l'entité Categorie pour convertir les valeur en string
            $image = $formRecette->get("image")->getData();
            if($image){
                $nomImage = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $nomImage= str_replace(" ", "_", $nomImage);
                $nomImage .= "_". uniqid().".".$image->guessExtension();
                $image->move($this->getParameter('dossier_images'), $nomImage);
                $nouvelle_recette->setImage($nomImage);
            }
            $nouvelle_recette->setMembre($this->getUser());
            $em->persist($nouvelle_recette);
            $em->flush();

            $nv_recette_id = $nouvelle_recette->getId();

            $id_recette_encours = $session->set('id_recette_encours', $nv_recette_id);
            

            
            return $this->redirectToRoute("ingredient_nouveau");
        }
        
        // dd($nouvelle_recette);
        return $this->render('recette/formRecette.html.twig', 
        ["formRecette" => $formRecette->createView(), 'titre'=> 'Nouvelle Recette', 'bouton'=>'Enregistrer' ]
    );
    }

 
     /**
     * @Route("/fiche/recette/{id}", name="recette_fiche", requirements={"id"="\d+"})
     * à cause de requirements, id doit être composé d'1 ou plusieurs chiffres 
     */
    public function fiche(RecetteRepository $ar, $id)
    {
        $recette = $ar->find($id);
        if(!empty($recette)){
            return $this->render("recette/fiche.html.twig", [ "recette" => $recette ]);
        }
        return $this->redirectToRoute("recette");
       
    }

    /**
     * @Route("/recette/modifier/{id}", name="recette_modifier", requirements={"id"="\d+"})
     */
    public function modifier(Request $rq, EntityManager $em, RecetteRepository $ar, $id)
    {
        // Modifier un recette existant
        // récupérer l'recette avec son id, l'afficher dans le formulaire et enregistrer les modifications dans la base de données
        $recetteAmodifier = $ar->find($id);
        $formRecette = $this->createForm(RecetteType::class, $recetteAmodifier);
        $formRecette->handleRequest($rq);
        if($formRecette->isSubmitted() && $formRecette->isValid()){
            $em->persist($recetteAmodifier);
            $em->flush();
            $this->addFlash("success", "Les informations de la recette ont été modifiées");
            return $this->redirectToRoute("recette");
        }
        return $this->render("recette/formRecette.html.twig", [ 
            "formRecette" => $formRecette->createView(), 
            "bouton" => "Modifier",
            "titre" => "Modification de l'recette n°$id" 
        ]);
    }

    /**
     * @Route("/admin/recette/modifier/{id}", name="admin_recette_modifier", requirements={"id"="\d+"})
     */
    public function modifier_admin(
        SessionInterface $session,
        PackIngredientRepository $ing, 
        Request $rq, 
        EntityManager $em, 
        RecetteRepository $ar, $id)
    {

        // $id_recette_modif = $session->get('id_recette_modif', []);
        $id_recette_modif = $session->set('id_recette_modif', $id);
        // dd($id);




        $recetteAmodifier = $ar->find($id);
        $image_origine = $recetteAmodifier->getImage();
        $formRecette = $this->createForm(RecetteType::class, $recetteAmodifier);
        $formRecette->handleRequest($rq);
       
        $nouveau_ingredient = new PackIngredient; 

        $formIngredient = $this->createForm(PackIngredientType::class, $nouveau_ingredient);
        $formIngredient->handleRequest($rq);

        
        if($formIngredient->isSubmitted() && $formIngredient->isValid()){
            $nouveau_ingredient->setRecette($recetteAmodifier);
            $em->persist($nouveau_ingredient);
            $em->flush();
            
            $PackIngredient = $ing->findByRecette($id);
            $total = 0;
            foreach ($PackIngredient as $key => $value){
                $total = $total + $PackIngredient[$key]->getPrix();
            }
            
            $recetteAmodifier->setPrix($total);
            $em->flush();

            return $this->redirectToRoute("admin_recette_modifier", ["id"=>$id]);
        }
       
       
        if($formRecette->isSubmitted() && $formRecette->isValid()){
            $image = $formRecette->get("image")->getData();

            // dd($image);
            if($image){
                $nomImage = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $nomImage= str_replace(" ", "_", $nomImage);
                $nomImage .= "_". uniqid().".".$image->guessExtension();
                $image->move($this->getParameter('dossier_images'), $nomImage);
                $recetteAmodifier->setImage($nomImage);
            } else {
                $recetteAmodifier->setImage($image_origine);
            }
            
            // $em->persist($recetteAmodifier);
            $em->flush();

            $id_recette_modif = $session->set('id_recette_modif', []);


            $this->addFlash("success", "Les informations de la recette ont été modifiées");
            return $this->redirectToRoute("admin_liste_recette");

        }
        return $this->render("recette/formbackoffice.html.twig", [ 
            "formRecette" => $formRecette->createView(), 
            "bouton" => "Modifier",
            "titre" => "Modification de l'recette n°$id", 
            "recetteAmodifier" => $recetteAmodifier,
            "formIngredient" => $formIngredient->createView()
        ]);
    }

    /**
     * @Route("/recette/supprimer/{id}", name="recette_supprimer", requirements={"id"="\d+"})
     */
    public function supprimer(
        Request $rq, 
        EntityManager $em, 
        RecetteRepository $recette, $id, 
        DetailcommandeRepository $detail)
    {
       
        $recette = $recette->find($id);
        $nomrecette = $recette->getTitre();

        // Verification s'i y a detailcommande en cours
        $verifDetail = $detail->findByRecette($id);
        if(!$verifDetail){
            
            $em = $this->getDoctrine()->getManager();
            $em->remove($recette);
            $em->flush();
            $this->addFlash('danger', "La recette  \"$nomrecette\"  a bien été supprimé!");
        } else {
            $this->addFlash('danger', "Cette recette ne peux pas être supprimé car il y a un ou des commandes en cours");
        }



        return $this->redirectToRoute("admin_liste_recette");
       
    }
    
    /**
     * @Route("/recette/categorie", name="categorie_recette")
     */
    public function liste_categorie(CategorieRepository $categorie)
    { 
        $liste_categorie = $categorie->findAll();
        return $this->render('recette/categorie.html.twig', [
            'liste_categorie' => $liste_categorie
        ]);
    }


    /**
     * @Route("/recette/categorie/new", name="ajouter_categorie")
     * 
     */
    public function ajouter_categorie(Request $request, EntityManager $em, CategorieRepository $categorie)
    {
        $nouvelle_categorie = new Categorie;

        $formCategorie = $this->createForm(CategorieType::class, $nouvelle_categorie);

        $formCategorie->handleRequest($request);

        if($formCategorie->isSubmitted() && $formCategorie->isValid()){

            $image = $formCategorie->get("image")->getData();

            if($image){
                $nomImage = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $nomImage= str_replace(" ", "_", $nomImage);
                $nomImage .= "_". uniqid().".".$image->guessExtension();
                $image->move($this->getParameter('dossier_images'), $nomImage);
                $nouvelle_categorie->setImage($nomImage);
            }
            $em->persist($nouvelle_categorie);
            $em->flush();

            return $this->redirectToRoute("categorie_recette");
        }

        return $this->render('recette/formCategorie.html.twig', 
        ["formCategorie" => $formCategorie->createView(), 'titre'=> 'Nouvelle Recette', 'bouton'=>'Enregistrer' ]
    );
    }

    /**
     * @Route("/recette/categorie/supprimer/{id}", name="categorie_supprimer", requirements={"id"="\d+"})
     */
    public function supprimer_categorie(Request $rq, EntityManager $em, CategorieRepository $categorie, $id, RecetteRepository $rec)
    {
        $verif_categorie = $rec->findByCategorie($id);
        $categorie_supprimer = $categorie->find($id);
        $nomcategorie = $categorie_supprimer->getCategorie();

        if(!$verif_categorie){

            // dd($nomcategorie);
    
            $em = $this->getDoctrine()->getManager();
            $em->remove($categorie_supprimer);
            $em->flush();
    
            $this->addFlash('success', "La categorie \"$nomcategorie\"  a bien été supprimé!");
        } else {
            $this->addFlash('danger', "La catégorie \"$nomcategorie\"  ne peut pas être supprimé, elle est afféctée à une ou plusieurs recettes");

        }

        return $this->redirectToRoute("categorie_recette");
       
    }

    /**
     * @Route("/recette/categorie/modifier/{id}", name="categorie_modifier", requirements={"id"="\d+"})
     */
    public function modifier_categorie(PackIngredientRepository $ing, Request $rq, EntityManager $em, CategorieRepository $categorie, $id)
    {


        

        $categorie_modifier = $categorie->find($id);
        $formCategorie = $this->createForm(CategorieType::class, $categorie_modifier);
        $formCategorie->handleRequest($rq);
        if($formCategorie->isSubmitted() && $formCategorie->isValid()){
            // $em->persist($categorie_modifier);
            $em->flush();
            $this->addFlash("success", "La catégorie à bien été modifié");
            return $this->redirectToRoute("categorie_recette");
        }
        return $this->render("recette/formCategorie.html.twig", [ 
            "formCategorie" => $formCategorie->createView(), 
            "bouton" => "Modifier",
            "titre" => "Modification de la catégorie n°$id" 
        ]);
    }

    /**
     * @Route("/recette/ingredient/nouveau", name="ingredient_nouveau")
     */
    public function ajout_ingredient(SessionInterface $session, RecetteRepository $rec, PackIngredientRepository $ing, Request $rq, EntityManager $em)
    {
        $nouveau_ingredient = new PackIngredient; 
        
        $id_recette_encours = $session->get('id_recette_encours', []);
        
        $recette = $rec->find($id_recette_encours);
        $PackIngredient = $ing->findByRecette($id_recette_encours);
        

        $formIngredient = $this->createForm(PackIngredientType::class, $nouveau_ingredient);
        $formIngredient->handleRequest($rq);
        if($formIngredient->isSubmitted() && $formIngredient->isValid()){
            $nouveau_ingredient->setRecette($recette);
            $em->persist($nouveau_ingredient);
            $em->flush();

            return $this->redirectToRoute("ingredient_nouveau");
        }
        return $this->render("recette/PackIngredient.html.twig", [ 
            "formIngredient" => $formIngredient->createView(),
            "ingredients"=> $PackIngredient,
     
        ]);
    }

    /**
     * @Route("/recette/ingredient/terminer", name="ingredient_terminer")
     */
    public function terminer(SessionInterface $session, PackIngredientRepository $ing, RecetteRepository $rec, EntityManager $em )
    {
        $id_recette_encours = $session->get('id_recette_encours', []);

        $recette = $rec->find($id_recette_encours);
        $PackIngredient = $ing->findByRecette($id_recette_encours);
        // dd($PackIngredient[0]);
        $total = 0;
        foreach ($PackIngredient as $key => $value){
            $total = $total + $PackIngredient[$key]->getPrix();
        }
        
        $recette->setPrix($total);
        $em->persist($recette);
        $em->flush();

        $id_recette_encours = $session->set('id_recette_encours', []);

        return $this->redirectToRoute("ajouter_recette");
    }


    /**
     * @Route("/admin/recette/envente/{id}", name="admin_recette_envente", requirements={"id"="\d+"})
     */
    public function mettre_en_vente(Request $rq, EntityManager $em, RecetteRepository $ar, $id)
    {
        $recette_en_vente = $ar->find($id);
        $recette_en_vente->setVente(true);
        $em->flush();

        return $this->redirectToRoute("admin_liste_recette");

    }
    /**
     * @Route("/admin/recette/envente_retourcategorie/{id}/{id_cat}", name="admin_recette_enventecat", requirements={"id"="\d+"})
     */
    public function mettre_en_ventecat(Request $rq, EntityManager $em, RecetteRepository $ar, $id, $id_cat)
    {
        $recette_en_vente = $ar->find($id);
        $recette_en_vente->setVente(true);
        $em->flush();

        return $this->redirectToRoute("recette_backoffice_recherche", ["id"=>$id_cat]);

    }

    /**
     * @Route("/admin/recette/retirer/{id}", name="admin_recette_retirer", requirements={"id"="\d+"})
     */
    public function retirer_vente(Request $rq, EntityManager $em, RecetteRepository $ar, $id)
    {
        $recette_en_vente = $ar->find($id);
        $recette_en_vente->setVente(false);
        $em->flush();

        return $this->redirectToRoute("admin_liste_recette");

    }
    
    /**
     * @Route("/admin/recette/retirer_retourcategorie/{id}/{id_cat}", name="admin_recette_retirercat", requirements={"id"="\d+"})
     */
    public function retirer_ventecat(Request $rq, EntityManager $em, RecetteRepository $ar, $id, $id_cat)
    {
        $recette_en_vente = $ar->find($id);
        $recette_en_vente->setVente(false);
        $em->flush();

        return $this->redirectToRoute("recette_backoffice_recherche", ["id"=>$id_cat]);

    }

    /**
     * @Route("/admin/recette/ingredient/supprimer/{id}", name="supprimer_ingredient", requirements={"id"="\d+"})
     */
    public function supprimer_ingredient(
            SessionInterface $session, 
            Request $rq, 
            EntityManager $em, $id, 
            PackIngredientRepository $ing,
            RecetteRepository $rec)
    {
        $id_recette_modif = $session->get('id_recette_modif');

        $ingredient = $ing->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($ingredient);
        $em->flush();

        // recalcul du total
        $recetteAmodifier = $rec->find($id_recette_modif);

        $PackIngredient = $ing->findByRecette($id_recette_modif);
        $total = 0;
        foreach ($PackIngredient as $key => $value){
            $total = $total + $PackIngredient[$key]->getPrix();
        }
        
        $recetteAmodifier->setPrix($total);
        $em->flush();

        return $this->redirectToRoute("admin_recette_modifier", ["id"=> $id_recette_modif]);

    }

}
