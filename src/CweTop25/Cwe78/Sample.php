<?php

namespace GSoares\CweTop25\Cwe78;

use GSoares\CweTop25\AbstractSample;
use Symfony\Component\HttpFoundation\Request;

class Sample extends AbstractSample
{

    /**
     * @param Request $request
     * @return array
     */
    public function processRequest(Request $request)
    {
        if ($request->getMethod() != 'POST') {
            return ['user' => null];
        }

        $command = null;
        $parameters = $this->getRequestParameters($request);

        $username = isset($parameters['username']) ? $parameters['username'] : null;

        if ($request->get('submit') == 'Unsafe submit' && $username) {
            $command = $this->unsafeCommand($username);
        }

        if ($request->get('submit') == 'Safe submit' && $username) {
            $command = $this->safeCommand($username);
        }

        return ['command' => $command];
    }

    /**
     * @param $username
     * @return \stdClass
     */
    private function unsafeCommand($username)
    {
        return $this->executeCommand($username);
    }

    /**
     * @param $username
     * @return \stdClass
     */
    private function safeCommand($username)
    {
        return [
            'raw' => $command = escapeshellcmd(escapeshellarg($username)),
            'response' => system($command)
        ];
    }

    /**
     * @param $username
     * @return array
     */
    private function executeCommand($username)
    {
        $command = 'ls -l /home/' . $username;

        return [
            'raw' => $command,
            'response' => system($command)
        ];
    }
}
