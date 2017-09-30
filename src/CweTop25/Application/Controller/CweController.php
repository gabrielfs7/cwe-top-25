<?php

namespace GSoares\CweTop25\Application\Controller;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class CweController extends AbstractController
{

    /**
     * @param string $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($id)
    {
        return $this->renderResponse(
            "cwe/$id.html.twig",
            [
                'cwe' => $this->getCweInfoById($id)
            ]
        );
    }
}
