<?php

namespace GSoares\CweTop25\Application\Controller;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
interface ControllerInterface extends ContainerAwareInterface
{

    /**
     * @param $templateFile
     * @param array $context
     * @param int $statusCode
     * @return Response
     */
    public function renderResponse($templateFile, array $context = [], $statusCode = 200);
}
