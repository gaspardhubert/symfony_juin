<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\AuteurType;
use App\Entity\Auteur;
use Date;

class AuteurController extends AbstractController
{
    #[Route('/auteurs', name: 'app_auteurs')]
    public function allAuteurs(ManagerRegistry $doctrine): Response
    {
        $auteurs = $doctrine->getRepository(Auteur::class)->findAll(); 
        
        return $this->render('auteur/allAuteurs.html.twig', [
        'auteurs' => $auteurs
    ]);
    }


#[Route('/ajout', name: 'auteur_ajout')]
    public function ajout(ManagerRegistry $doctrine, Request $request)
    {
        $auteur = new Auteur();
        // on crée le formulaire en liant le FormType à l'objet créé
        $form = $this->createForm(AuteurType::class, $auteur);
        // on donne accès aux données du formulaire pour la validation des données
        $form->handleRequest($request);
        // si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid())
        {
            // on récupère le manager de doctrine
            $manager = $doctrine->getManager();
            // on persist l'objet
            $manager->persist($auteur);
            // puis on envoie en bdd
            $manager->flush();

            return $this->redirectToRoute("app_auteurs");

        }
    return $this->render("auteur/formAuteur.html.twig", ['formAuteur' => $form->createView()]);

    }

     #[Route('/update-auteur/{id}', name: 'auteur_update')]
    public function update(ManagerRegistry $doctrine, $id, Request $request)// $id aura comme valeur l'id passé en paramètre de la route
    {
        // on récupère l'auteur dont l'id est celui passé en paramètre de la fonction
        $auteur = $doctrine->getRepository(AUteur::class)->find($id);
        
       $form = $this->createForm(AuteurType::class, $auteur);
        // on donne accès aux données du formulaire pour la validation des données
        $form->handleRequest($request);
        // si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid())
        {
            $manager = $doctrine->getManager();
            // on persist l'objet
            $manager->persist($auteur);
            // puis on envoie en bdd
            $manager->flush();

            return $this->redirectToRoute("app_auteurs");

        }
    return $this->render("auteur/formAuteur.html.twig", ['formAuteur' => $form->createView()]);

    }

    #[Route('/delete-auteur_{id}', name: 'auteur_delete')]
    public function delete($id, ManagerRegistry $doctrine)
    {
            // on récupère l'auteur à supprimer    
        $auteur = $doctrine->getRepository(Auteur::class)->find($id);
            // on récupère le manager de doctrine
        $manager = $doctrine->getManager();
            // on prépare la suppression de l'auteur
        $manager->remove($auteur);
            // pon exécute l'action (suppression)
        $manager->flush();   
        
        return $this->redirectToRoute("app_auteurs");

    }

      #[Route('/auteur_{id}', name: 'app_auteur')]
      public function showAuteur($id, ManagerRegistry $doctrine) {

        $auteur = $doctrine->getRepository(Auteur::class)->find($id);

        return $this->render("auteur/unAuteur.html.twig", [
            'auteur' => $auteur
        ]);

      }

}
