<?php

namespace GSoares\CweTop25\Application\Controller;

use Symfony\Component\HttpFoundation\Request;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class CweController extends AbstractController
{

    /**
     * @param string $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, $id)
    {
        $responseParams = $this->container
            ->get("cwe.$id.sample")
            ->processRequest($request);

        return $this->renderResponse(
            "cwe/$id.html.twig",
            array_merge(['cwe' => $this->getCweInfoById($id)], $responseParams)
        );
    }
}
