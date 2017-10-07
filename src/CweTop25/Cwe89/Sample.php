<?php

namespace GSoares\CweTop25\Cwe89;

use GSoares\CweTop25\AbstractSample;

class Sample extends AbstractSample
{

    /**
     * @var \PDO
     */
    private $connection;

    /**
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return array
     */
    public function internalProcess()
    {
        if (!$this->isPost()) {
            return [];
        }

        if ($this->isUnSafeSubmit()) {
            $user = $this->unsafeQuery();
        }

        if ($this->isSafeSubmit()) {
            $user = $this->safeQuery();
        }

        return ['user' => $user];
    }

    /**
     * @return \stdClass
     */
    private function unsafeQuery()
    {
        $username = $this->getRequestParameter('username');
        $password = $this->getRequestParameter('password');

        $query = "SELECT * FROM User WHERE name = '" . $username . "' AND password = '" . $password . "'";

        return $this->executeQuery($query);
    }

    /**
     * @return \stdClass
     */
    private function safeQuery()
    {
        $query = "SELECT * FROM User WHERE name = ? AND password = ?";

        return $this->executeQuery(
            $query,
            [
                $this->getRequestParameter('username'),
                $this->getRequestParameter('password')
            ]
        );
    }

    /**
     * @param $query
     * @param array $parameters
     * @return \stdClass
     */
    private function executeQuery($query, array $parameters = [])
    {
        $statement = $this->connection->prepare($query);
        $statement->execute($parameters);

        return $statement->fetchObject();
    }
}
