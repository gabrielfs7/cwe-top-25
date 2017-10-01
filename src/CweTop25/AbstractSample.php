<?php

namespace GSoares\CweTop25;

abstract class AbstractSample implements SampleInterface
{

    /**
     * @return array
     */
    public function getFileContent()
    {
        $className = __CLASS__;

        return file_get_contents(
            __DIR__ . '/' . str_replace(['GSoares\CweTop25\\', '\\'], ['', '/'], $className) . '.php'
        );
    }
}