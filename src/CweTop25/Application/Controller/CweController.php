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
        $service = $this->container
            ->get("cwe.$id.sample");

        return $this->renderResponse(
            "cwe/$id.html.twig",
            array_merge(
                [
                    'sampleClass' => [
                        'name' => get_class($service),
                        'content' => $service->getFileContent(),
                    ],
                    'cwe' => $this->getCweInfoById($id)
                ],
                $service->processRequest($request)
            )
        );
    }
}
