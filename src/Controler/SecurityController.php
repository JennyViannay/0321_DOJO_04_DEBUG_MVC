<?php

/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\UserManager;

class SecurityController extends AbstractController
{
    public function register()
    {
        $userManager = new UserManager();
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['check_pass'])) {
                $user = $userManager->searchUser($_POST['username']);
                if (!$user) {
                    if ($_POST['password'] === $_POST['check_pass']) {
                        if (strlen($_POST['password']) >= 4 && strlen($_POST['password']) <= 10) {
                            $user = [
                                'username' => $_POST['username'],
                                'password' => md5($_POST['password']),
                                'role_id' => 2
                            ];
                            $id = $userManager->insert($user);
                            if ($id) {
                                $_SESSION['user'] = $userManager->selectOneById($id);
                                header('Location: /');
                            }
                        } else {
                            $errors[] = "Le mot de passe doit contenir entre 4 et 10 caractères !";
                        }
                    } else {
                        $errors[] = "Les mots de passe ne correspondent pas !";
                    }
                } else {
                    $errors[] = "Username exist !";
                }
            } else {
                $errors[] = "Tous les champs sont requis !";
            }
        }
        return $this->twig->render('Security/register.html.twig', ['errors' => $errors]);
    }

    public function login()
    {
        $userManager = new UserManager();
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $user = $userManager->searchUser($_POST['username']);
                if ($user) {
                    if ($user['password'] === md5($_POST['password'])) {
                        $_SESSION['user'] = $user;
                        header('Location: /');
                    } else {
                        $errors[] = "Mot de passe invalide !";
                    }
                } else {
                    $errors[] = "Le nom d'utilisateur n'existe pas !";
                }
            }
        } else {
            $errors[] = "Tous les champs sont requis !";
        }
        return $this->twig->render('Security/login.html.twig', ['errors' => $errors]);
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
    }
}
