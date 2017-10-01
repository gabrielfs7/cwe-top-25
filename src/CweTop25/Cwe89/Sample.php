<?php

namespace GSoares\CweTop25\Cwe89;

use GSoares\CweTop25\AbstractSample;
use Symfony\Component\HttpFoundation\Request;

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
     * @param Request $request
     * @return array
     */
    public function processRequest(Request $request)
    {
        if ($request->getMethod() != 'POST') {
            return ['user' => null];
        }

        $user = null;
        $parameters = $this->getRequestParameters($request);

        if ($request->get('submit') == 'Unsafe submit') {
            $user = $this->unsafeQuery($parameters);
        }

        if ($request->get('submit') == 'Safe submit') {
            $user = $this->safeQuery($parameters);
        }

        return ['user' => $user];
    }

    /**
     * @param $externalParameter
     * @return \stdClass
     */
    private function unsafeQuery(array $externalParameter)
    {
        $username = isset($externalParameter['username']) ? $externalParameter['username'] : null;
        $password = isset($externalParameter['password']) ? $externalParameter['password'] : null;

        $query = "SELECT * FROM User WHERE name = '" . $username . "' AND password = '" . $password . "'";

        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement->fetchObject();
    }

    /**
     * @param $externalParameter
     * @return \stdClass
     */
    private function safeQuery(array $externalParameter)
    {
        $username = $externalParameter['username'];
        $password = $externalParameter['password'];

        $query = "SELECT * FROM User WHERE name = ? AND password = ?";

        $statement = $this->connection->prepare($query);
        $statement->execute([$username, $password]);

        return $statement->fetchObject();
    }
}
