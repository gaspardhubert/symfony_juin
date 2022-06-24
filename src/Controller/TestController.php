<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index()
    {

        $prenom = 'Koko';
         $nom = 'Lonsi';

         $identite =
         ['personne1' => ['prenom' => 'Banacek', 'nom' => 'Carrington'],
            'personne2' => ['prenom' => 'Compay', 'nom' => 'Gato']];

        return $this->render("test.html.twig", [
        'prenom' => $prenom,
        'nom' => $nom,
        'identite' => $identite
    ]);
    }
}
