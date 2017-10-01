<?php

namespace GSoares\CweTop25\Application\Controller;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Gabriel Felipe Soares <gabrielfs7@gmail.com>
 */
class AbstractController implements ControllerInterface
{
    use ContainerAwareTrait;

    /**
     * @param $templateFile
     * @param array $context
     * @param int $statusCode
     * @return Response
     */
    public function renderResponse($templateFile, array $context = [], $statusCode = 200)
    {
        $content = $this->container
            ->get('twig.environment')
            ->render($templateFile, array_merge($context, ['cweMenu' => $this->getCweMenu()]));

        return new Response($content, $statusCode);
    }

    /**
     * @param $id
     * @return mixed
     */
    protected function getCweInfoById($id)
    {
        return current(
            array_filter(
                $this->getCweMenu(),
                function ($val) use ($id) {
                    return array_search("CWE-$id", (array) $val) !== false;
                }
            )
        );
    }

    /**
     * @return array
     */
    private function getCweMenu()
    {
        $filePath = $this->container->getParameter('root.path') . '/resources/cwe-top-25.json';

        return json_decode(file_get_contents($filePath));
    }
}
