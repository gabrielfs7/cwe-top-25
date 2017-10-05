<?php

namespace GSoares\CweTop25;

use Symfony\Component\HttpFoundation\Request;

abstract class AbstractSample implements SampleInterface
{

    /**
     * @return array
     */
    public function getFileContent()
    {
        $className = get_called_class();

        return file_get_contents(
            __DIR__ . '/' . str_replace(['GSoares\CweTop25\\', '\\'], ['', '/'], $className) . '.php'
        );
    }

    /**
     * @param Request $request
     * @return array
     */
    protected function getRequestParameters(Request $request)
    {
        $postParametersBag = $request->request;
        $queryParametersBag = $request->query;

        return array_merge($postParametersBag->all(), $queryParametersBag->all());
    }
}
