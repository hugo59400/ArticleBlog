<?php

namespace App\Controller;
use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Time;

class BlogController extends AbstractController
{
    /** 
     * @Route("/blog/{page<\d+>}", name="blog")
     */
    public function index($page = 1): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $articleRepository = $entityManager->getRepository(Article::class);

        $articles = $articleRepository->findAll();

        return $this->render('blog/index.html.twig', [
            'controller_name' => 'BlogController',
            'numpage' => $page,
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response
    {
        return $this->render('blog/contact.html.twig', [
            'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/addArticle", name="addArticle")
     */
    public function addArticle(): Response
    {
        $article = new Article();
        $article->setTitre("Le titre de mon article");
        $article->setContenu("Voici le contenu de mon article <br> merci <br> A bientot !");
        $article->setDateCreation(new \DateTime());

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->persist($article);
        $entityManager->flush();

        return $this->redirectToRoute('blog/index.html.twig', [
        ]);
    }



   /**
     * @Route("/article/{id}", name="voir_article")
     */
    public function article($id): Response
  {
    $entityManager = $this->getDoctrine()->getManager();

    $articleRepository = $entityManager->getRepository(Article::class);

    $article = $articleRepository->find($id);



    return $this->redirectToRoute('blog/article.html.twig', [
        'article' => $article
        ]);




}












}