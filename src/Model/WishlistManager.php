<?php

/**
 * Created by PhpStorm.
 * User: sylvain
 * Date: 07/03/18
 * Time: 18:20
 * PHP version 7
 */

namespace App\Model;

/**
 *
 */
class WishlistManager extends AbstractManager
{
    public const TABLE = 'wishlist';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $wish
     * @return int
     */
    public function insert(array $wish): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (user_id, article_id) VALUES (:user_id, :article_id)");
        $statement->bindValue('user_id', $wish['user_id'], \PDO::PARAM_INT);
        $statement->bindValue('article_id', $wish['article_id'], \PDO::PARAM_INT);

        $statement->execute();
        return (int)$this->pdo->lastInsertId();
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }

    public function getWishlistByUser(int $idUser)
    {
        $statement = $this->pdo->prepare("SELECT id, article_id FROM " . self::TABLE . " WHERE user_id = :user_id");
        $statement->bindValue(':user_id', $idUser, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function isLikedByUser(int $idArticle, int $idUser)
    {
        $statement = $this->pdo->prepare("SELECT * FROM " . self::TABLE .
        " WHERE article_id = :article_id AND user_id = :user_id");
        $statement->bindValue(':article_id', $idArticle, \PDO::PARAM_INT);
        $statement->bindValue(':user_id', $idUser, \PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch();
    }
}
