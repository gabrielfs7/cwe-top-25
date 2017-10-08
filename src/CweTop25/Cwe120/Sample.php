<?php

namespace GSoares\CweTop25\Cwe120;

use GSoares\CweTop25\AbstractSample;

class Sample extends AbstractSample
{

    /**
     * @return array
     */
    public function internalProcess()
    {
        return [
            'sampleFiles' => [
                'resources/c/cwe120-1',
                'resources/c/cwe120-2',
            ]
        ];
    }
}
