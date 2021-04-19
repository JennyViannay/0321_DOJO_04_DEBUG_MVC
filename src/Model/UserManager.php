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
class UserManager extends AbstractManager
{
    public const TABLE = 'user';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $user
     * @return int
     */
    public function insert(array $user): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO " . self::TABLE .
        " (`username`,`password`,`role_id`) VALUES (:username, :password, :role_id)");
        $statement->bindValue('username', $user['username'], \PDO::PARAM_STR);
        $statement->bindValue('password', $user['password'], \PDO::PARAM_STR);
        $statement->bindValue('role_id', $user['role_id'], \PDO::PARAM_INT);

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
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $user
     * @return bool
     */
    public function update(array $user): bool
    {
        // prepared request
        $statement = $this->pdo->prepare("UPDATE " . self::TABLE .
        " SET `username` = :username, `password` = :password WHERE id=:id");
        $statement->bindValue('id', $user['id'], \PDO::PARAM_INT);
        $statement->bindValue('username', $user['username'], \PDO::PARAM_STR);
        $statement->bindValue('password', $user['password'], \PDO::PARAM_STR);

        return $statement->execute();
    }

    public function searchUser(string $username)
    {
        $statement = $this->pdo->prepare('SELECT * FROM ' . self::TABLE . " WHERE username = :username");
        $statement->bindValue('username', $username, \PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch();
    }
}
