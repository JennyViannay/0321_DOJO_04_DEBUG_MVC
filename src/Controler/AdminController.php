<?php

namespace App\Controller;

use App\Model\ArticleManager;
use App\Model\CategorieManager;

class AdminController extends AbstractController
{
    public function index()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1) {
            $articleManager = new ArticleManager();
            $articles = $articleManager->selectAll();
            return $this->twig->render('Admin/index.html.twig', ['articles' => $articles]);
        } else {
            header('Location: /');
        }
    }

    public function addArticle()
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1) {
            $categorieManager = new CategorieManager();

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $articleManager = new ArticleManager();
                $article = [
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'price' => $_POST['price'],
                    'hours' => $_POST['hours'],
                    'image' => $_POST['image'],
                    'categorie_id' => $_POST['categorie_id'],
                ];
                $id = $articleManager->insert($article);
                header('Location:/article/show/' . $id);
            }

            return $this->twig->render('Article/add.html.twig', ['categories' => $categorieManager->selectAll()]);
        } else {
            header('Location: /');
        }
    }

    public function deleteArticle(int $id)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1) {
            $articleManager = new ArticleManager();
            $articleManager->delete($id);
            header('Location:/article/index');
        } else {
            header('Location: /');
        }
    }

    public function editArticle(int $id)
    {
        if (isset($_SESSION['user']) && $_SESSION['user']['role_id'] == 1) {
            $articleManager = new ArticleManager();
            $article = $articleManager->selectOneById($id);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $article['title'] = $_POST['title'];
                $article['description'] = $_POST['description'];
                $article['price'] = $_POST['price'];
                $article['hours'] = $_POST['hours'];
                $article['image'] = $_POST['image'];
                $article['categorie_id'] = $_POST['categorie_id'];
                $articleManager->update($article);
            }

            return $this->twig->render('Article/edit.html.twig', ['article' => $article]);
        } else {
            header('Location: /');
        }
    }

    public function editCategorie(int $id): string
    {
        $categorieManager = new CategorieManager();
        $categorie = $categorieManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categorie['name'] = $_POST['name'];
            $categorieManager->update($categorie);
        }

        return $this->twig->render('Categorie/edit.html.twig', ['categorie' => $categorie]);
    }

    public function addCategorie()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $categorieManager = new CategorieManager();
            $categorie = [
                'name' => $_POST['name'],
            ];
            $id = $categorieManager->insert($categorie);
            header('Location:/categorie/show/' . $id);
        }

        return $this->twig->render('Categorie/add.html.twig');
    }

    public function deleteCategorie(int $id)
    {
        $categorieManager = new CategorieManager();
        $categorieManager->delete($id);
        header('Location:/categorie/index');
    }
}
