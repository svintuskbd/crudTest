<?php

namespace BlogBundle\Controller;

use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/blog-list", name="blog_index_route")
     */
    public function indexAction()
    {
        $articleRepos = $this->getDoctrine()->getRepository(Article::class);
        $articles = $articleRepos->findAll();

        return $this->render('@Blog/CRUD/article_list.html.twig', [
            'articles' => $articles
        ]);
    }
}
