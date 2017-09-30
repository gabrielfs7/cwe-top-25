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

        $responseParams = $service->processRequest($request);
        $className = get_class($service);
        $content = file_get_contents(__DIR__ . '/../../' . str_replace(['GSoares\CweTop25\\', '\\'], ['', '/'], $className) . '.php');

        return $this->renderResponse(
            "cwe/$id.html.twig",
            array_merge(
                [
                    'sampleClass' => [
                        'name' => $className,
                        'content' => $content,
                    ],
                    'cwe' => $this->getCweInfoById($id)
                ],
                $responseParams
            )
        );
    }
}
