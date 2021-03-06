<?php

namespace GSoares\CweTop25;

use Symfony\Component\HttpFoundation\Request;

abstract class AbstractSample implements SampleInterface
{

    /**
     * @var Request
     */
    private $request;

    /**
     * @param Request $request
     * @return array
     */
    public function processRequest(Request $request)
    {
        $this->request = $request;

        return $this->internalProcess();
    }

    /**
     * @return array
     */
    public function getFileContent()
    {
        $classPath = str_replace(['GSoares\CweTop25\\', '\\'], ['', '/'], get_called_class());

        return file_get_contents(__DIR__ . "/$classPath.php");
    }

    /**
     * @return array
     */
    abstract protected function internalProcess();

    /**
     * @param $parameter
     * @return string
     */
    protected function getRequestParameter($parameter)
    {
        return $this->request->get($parameter);
    }

    /**
     * @return bool
     */
    protected function isPost()
    {
        return $this->request->getMethod() == 'POST';
    }

    /**
     * @return bool
     */
    protected function isSafeSubmit()
    {
        return $this->request->get('submit') == 'Safe submit';
    }

    /**
     * @return bool
     */
    protected function isUnSafeSubmit()
    {
        return $this->request->get('submit') == 'Unsafe submit';
    }
}
