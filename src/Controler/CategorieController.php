<?php

namespace App\Controller;

use App\Model\CategorieManager;

class CategorieController extends AbstractController
{
    public function index()
    {
        $categorieManager = new CategorieManager();
        $categories = $categorieManager->selectAll();

        return $this->twig->render('Categorie/index.html.twig', ['categories' => $categories]);
    }

    public function show(int $id)
    {
        $categorieManager = new CategorieManager();
        $categorie = $categorieManager->selectOneById($id);

        return $this->twig->render('Categorie/show.html.twig', ['categorie' => $categorie]);
    }
}
