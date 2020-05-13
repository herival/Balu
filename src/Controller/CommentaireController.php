<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\RecetteRepository;
use App\Repository\CommentaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CommentaireController extends AbstractController
{
    /**
     * @Route("/admin/commentaire", name="liste_commentaire")
     */
    public function liste_commentaire(CommentaireRepository $comment)
    {
        $commentaire = $comment->findAll(); 

        return $this->render('commentaire/listecommentairebo.html.twig', [
            'commentaire' => $commentaire
        ]);
    }

    /**
     * @Route("/admin/commentaire/positif", name="commentaire_positif")
     */
    public function commentaire_positif(CommentaireRepository $comment)
    {
        $commentaire = $comment->findByNote_positif(5); 

        return $this->render('commentaire/listecommentairebo.html.twig', [
            'commentaire' => $commentaire
        ]);
    }

    /**
     * @Route("/admin/commentaire/negatif", name="commentaire_negatif")
     */
    public function commentaire_negatif(CommentaireRepository $comment)
    {
        $commentaire = $comment->findByNote_negatif(5); 

        return $this->render('commentaire/listecommentairebo.html.twig', [
            'commentaire' => $commentaire
        ]);
    }
    /**
     * @Route("/commentaire/ajouter/{id}", name="ajout_commentaire")
     */
    public function ajout_commentaire(
        CommentaireRepository $comment,
        Request $request, 
        EntityManager $em,
        RecetteRepository $rec, $id)
    {
        $recette = $rec->find($id);
        $nouveau_commentaire = new Commentaire;
        $formCommentaire = $this->createForm(CommentaireType::class, $nouveau_commentaire);
        $formCommentaire->handleRequest($request);

        if($formCommentaire->isSubmitted() && $formCommentaire->isValid()){
            $note = $formCommentaire->get("note")->getData();

            $denominateur = $comment->findByRecette($id);
            $total = $comment->MoyenneRecette($id);
            
            //dd(($total[0]['moyenne']+$note)/ count($denominateur));
            
            
            $nouveau_commentaire->setRecette($recette);
            $nouveau_commentaire->setMembre($this->getUser());
            if ($denominateur){
                $recette->setNote((($total[0]['moyenne']+$note)/ (count($denominateur)+1)));
            } else 
                $recette->setNote($note);
            $em->persist($nouveau_commentaire);
            
            $em->flush();

            
            
            return $this->redirectToRoute("fiche_recette", ["id"=>$id]);
        }




        return $this->render('commentaire/nvCommentaire.html.twig', [
            'formCommentaire' => $formCommentaire->createView(),
        ]);
    }

    /**
     * @Route("/admin/commentaire/supprimer/{id}", name="supprimer_commentaire")
     */
    public function supprimer_commentaire($id, CommentaireRepository $comment)
    {
        $commentaire = $comment->find($id); 

            $em = $this->getDoctrine()->getManager();
            $em->remove($commentaire);
            $em->flush();

            $this->addFlash('success', "Le commentaire a bien été supprimé!");


        return $this->redirectToRoute("liste_commentaire");
     
    }

    
}
