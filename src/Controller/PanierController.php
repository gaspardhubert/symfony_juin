<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
     #[Route('/produits', name: 'produits')]
    public function afficheProduit()
    {
         $produits =
         ['produit1' => ['id' => '1', 'titre' => 'mangue', 'description' => 'fruit exotique', 'prix' => '4'],
        'produit2' => ['id' => '2', 'titre' => 'poire', 'description' => 'fruit local', 'prix' => '6'],
		 'produit3' => ['id' => '3', 'titre' => 'banane', 'description' => 'fruit outre-mer', 'prix' => '8'],
		'produit4' => ['id' => '4', 'titre' => 'ananas', 'description' => 'fruit exotique', 'prix' => '5']];

        return $this->render('panier/produits.html.twig', [
        'produits' => $produits
    ]);
    }
}
