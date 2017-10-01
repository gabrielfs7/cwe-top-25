<?php

namespace GSoares\CweTop25;

use Symfony\Component\HttpFoundation\Request;

interface SampleInterface
{

    /**
     * @param Request $request
     * @return array
     */
    public function processRequest(Request $request);

    /**
     * @return array
     */
    public function getFileContent();
}
