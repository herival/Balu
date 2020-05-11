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
     * @Route("/commentaire", name="commentaire")
     */
    public function index()
    {
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
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
            $nouveau_commentaire->setRecette($recette);
            $nouveau_commentaire->setMembre($this->getUser());
            $em->persist($nouveau_commentaire);
            $em->flush();

            return $this->redirectToRoute("fiche_recette", ["id"=>$id]);
        }


        return $this->render('commentaire/nvCommentaire.html.twig', [
            'formCommentaire' => $formCommentaire->createView(),
        ]);
    }
}
