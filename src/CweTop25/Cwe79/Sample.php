<?php

namespace GSoares\CweTop25\Cwe79;

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
        $parameters = $this->getRequestParameters($request);

        $query = isset($parameters['query']) ? $parameters['query'] : null;
        $username = isset($parameters['username']) ? $parameters['username'] : null;

        if ($request->get('submit') == 'Safe submit' && $query) {
            $query = $this->safeSearch($query);
        }

        if (isset($parameters['safe'])) {
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
