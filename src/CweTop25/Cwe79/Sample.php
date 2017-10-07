<?php

namespace GSoares\CweTop25\Cwe79;

use GSoares\CweTop25\AbstractSample;

class Sample extends AbstractSample
{

    /**
     * @return array
     */
    public function internalProcess()
    {
        $query = $this->getRequestParameter('query');
        $username = $this->getRequestParameter('username');

        if ($this->isSafeSubmit() && $query) {
            $query = $this->safeSearch($query);
        }

        if ($this->getRequestParameter('safe')) {
            $username = $this->safeUsername($username);
        }

        return ['search' => $query, 'username' => $username];
    }

    /**
     * @param $search
     * @return \stdClass
     */
    private function safeSearch($search)
    {
        return htmlentities($search);
    }

    /**
     * @param $username
     * @return \stdClass
     */
    private function safeUsername($username)
    {
        return preg_replace('/[^0-9a-z]/', '', $username);
    }
}
