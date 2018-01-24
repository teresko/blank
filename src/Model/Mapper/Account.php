<?php

namespace Model\Mapper;

use PDO;
use DateTimeImmutable;
use Component\DataMapper;
use Model\Entity;


class Account extends DataMapper
{

    public function exists(Entity\Account $account)
    {
        $sql = "SELECT 1
                  FROM {$this->configuration['accounts']['primary']}
                 WHERE account_id = :id";

        $statement = $this->connection->prepare($sql);

        $statement->bindValue(':id', $account->getId(), PDO::PARAM_INT);
        $statement->execute();

        $data = $statement->fetch();

        return empty($data) === false;
    }


    public function store(Entity\Account $account)
    {
        $sql = "INSERT INTO {$this->configuration['accounts']['primary']} (created_on) VALUES (:timestamp)";
        $statement = $this->connection->prepare($sql);

        $datetime = $account->getCreatedOn();

        $statement->bindValue(':timestamp', $datetime->getTimestamp(), PDO::PARAM_INT);
        $statement->execute();

        $account->setId($this->connection->lastInsertId());
    }


    public function fetch(Entity\Account $account)
    {
        $sql = "SELECT created_on AS `timestamp`
                  FROM {$this->configuration['accounts']['primary']}
                 WHERE account_id = :account";

        $statement = $this->connection->prepare($sql);

        $statement->bindValue(':account', $account->getId(), PDO::PARAM_INT);

        $statement->execute();

        $data = $statement->fetch();

        if ($data) {
            $datetime = (new DateTimeImmutable)->setTimestamp($data['timestamp']);
            $account->setCreatedOn($datetime);
        }
    }
}
