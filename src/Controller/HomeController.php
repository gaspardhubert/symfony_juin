<?php

namespace App\Controller;

use App\Entity\Article;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function index(ManagerRegistry $doctrine): Response
    {
        // on cherche le dernier artocle inséré en BDD en utilisant le repository de la classe Article (ArticleRepository)
        $dernierArticle = $doctrine->getRepository(Article::class)-> findOneBy([],
        ["dateDeCreation" => "DESC"]);

        //dd($dernierArticle);

        return $this->render('home/index.html.twig', ['dernierArticle' => $dernierArticle]);
    }
}
