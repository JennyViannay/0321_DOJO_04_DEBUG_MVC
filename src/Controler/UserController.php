<?php

namespace App\Controller;

use App\Model\ArticleManager;
use App\Model\WishlistManager;

class UserController extends AbstractController
{
    // localhost:8000/user/account
    public function account()
    {
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            $wishManager = new WishlistManager();
            $articleManager = new ArticleManager();
            // wishlist article_id
            $wishlist = $wishManager->getWishlistByUser($_SESSION['user']['id']);
            $result = [];
            foreach ($wishlist as $wish) {
                $article = $articleManager->selectOneById($wish['article_id']);
                $result[] = ["wish_id" => $wish['id'], "article" => $article];
            }

            return $this->twig->render('User/account.html.twig', [
                'wishlist' => $result
            ]);
        }
        header('Location: /security/login');
    }
}
