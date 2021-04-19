<?php

namespace App\Controller;

use App\Model\ArticleManager;
use App\Model\CategorieManager;

class ArticleController extends AbstractController
{
    public function index()
    {
        // TODO :: SEND ALL ARTICLES TO THE TEMPLATE
        return $this->twig->render('Article/index.html.twig');
    }

    public function show(int $id)
    {
        $articleManager = new ArticleManager();
        $article = $articleManager->selectOneById($id);

        return $this->twig->render('Article/show.html.twig', ['article' => $article]);
    }
}
