<?php

namespace GSoares\CweTop25\Cwe78;

use GSoares\CweTop25\AbstractSample;

class Sample extends AbstractSample
{

    /**
     * @return array
     */
    protected function internalProcess()
    {
        if (!$this->isPost()) {
            return [];
        }

        if (!$username = $this->getRequestParameter('username')) {
            return [];
        }

        if ($this->isUnSafeSubmit()) {
            $command = $this->unsafeCommand($username);
        }

        if ($this->isSafeSubmit()) {
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
