<?php

namespace GSoares\CweTop25\Application\Controller;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class IndexController extends AbstractController
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->renderResponse(
            'index.html.twig',
            [

            ]
        );
    }
}
