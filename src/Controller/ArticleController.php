<?php

namespace App\Controller;
use App\Repository\ArticleRepository;
use App\Form\FormulaireType;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'article_index',methods:['GET'])]
    public function index(ArticleRepository $articleRepository ): Response
    {

        $articles = $articleRepository->findAll();

        
        return $this->render('article/index.html.twig', [
            'articles' => $articles,
            
        ]);
    }

    #[Route('/new', name: 'new_article',methods:['GET', 'POST'])]
     public function new(Request $request, EntityManagerInterface $entityManager )
     {
        $article = new Article();
        $form = $this->createForm(FormulaireType::class,$article);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
        
        $article = $form->getData();
        $entityManager->persist($article);
        $entityManager -> flush();
        return $this->redirectToRoute('article_index');
        }
         return $this->render('/article/new.html.twig',[

             'form'=> $form,
         ]);
            
     }



    
}


