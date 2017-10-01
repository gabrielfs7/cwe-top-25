<?php

namespace GSoares\CweTop25\Application\Controller;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class QualityControlController extends AbstractController
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function phpUnitAction()
    {
        return $this->renderResponse("phpunit/index.html.twig");
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function phpCsAction()
    {
        return $this->renderResponse("phpcs/index.html.twig");
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function phpMdAction()
    {
        return $this->renderResponse("phpmd/index.html.twig");
    }
}
