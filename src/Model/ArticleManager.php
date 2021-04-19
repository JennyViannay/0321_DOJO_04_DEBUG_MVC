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
class ArticleManager extend AbstractManager
{
    public const TABLE = 'article';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    public function selectAll(): array
    {
        return $this->pdo->query('SELECT * FROM ' . self::TABLE . '
        ORDER BY id DESC')->fetchAll();
    }

    /**
     * @param array $article
     * @return int
     */
    public function insert(array $article): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (`title`, `description`, `price`, `hours`, `image`,`categorie_id`) 
        VALUES (:title, :description, :price, :hours, :image, :categorie_id)");
        $statement->bindValue('title', $article['title'], \PDO::PARAM_STR);
        $statement->bindValue('description', $article['description'], \PDO::PARAM_STR);
        $statement->bindValue('price', $article['price'], \PDO::PARAM_INT);
        $statement->bindValue('hours', $article['hours'], \PDO::PARAM_INT);
        $statement->bindValue('image', $article['image'], \PDO::PARAM_STR);
        $statement->bindValue('categorie_id', $article['categorie_id'], \PDO::PARAM_INT);

        $statement->execute();
        return (int) $this->pdo->lastInsertId();
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $article
     * @return bool
     */
    public function update(array $article): bool
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " SET `title` = :title, `description` = :description, `price` = :price,
        `hours` = :hours, `image` = :image, `categorie_id` = :categorie_id
        WHERE id=:id");
        $statement->bindValue('id', $article['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $article['title'], \PDO::PARAM_STR);
        $statement->bindValue('description', $article['description'], \PDO::PARAM_STR);
        $statement->bindValue('price', $article['price'], \PDO::PARAM_INT);
        $statement->bindValue('hours', $article['hours'], \PDO::PARAM_INT);
        $statement->bindValue('image', $article['image'], \PDO::PARAM_STR);
        $statement->bindValue('categorie_id', $article['categorie_id'], \PDO::PARAM_INT);

        return $statement->execute();
    }
}
