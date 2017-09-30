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
     * @return array
     */
    private function getCweMenu()
    {
        return [
            ['position' => 1, 'score' => 93.8, 'id' => 'CWE-89', 'description' => 'Improper Neutralization of Special Elements used in an SQL Command (SQL Injection)'],
            ['position' => 2, 'score' => 83.3, 'id' => 'CWE-78', 'description' => 'Improper Neutralization of Special Elements used in an OS Command (OS Command Injection)'],
            ['position' => 3, 'score' => 79.0, 'id' => 'CWE-120', 'description' => 'Buffer Copy without Checking Size of Input (Classic Buffer Overflow)'],
            ['position' => 4, 'score' => 77.7, 'id' => 'CWE-79', 'description' => 'Improper Neutralization of Input During Web Page Generation (Cross-site Scripting)'],
            ['position' => 5, 'score' => 76.9, 'id' => 'CWE-306', 'description' => 'Missing Authentication for Critical Function'],
            ['position' => 6, 'score' => 76.8, 'id' => 'CWE-862', 'description' => 'Missing Authorization'],
            ['position' => 7, 'score' => 75.0, 'id' => 'CWE-798', 'description' => 'Use of Hard-coded Credentials'],
            ['position' => 8, 'score' => 75.0, 'id' => 'CWE-311', 'description' => 'Missing Encryption of Sensitive Data'],
            ['position' => 9, 'score' => 74.0, 'id' => 'CWE-434', 'description' => 'Unrestricted Upload of File with Dangerous Type'],
            ['position' => 10, 'score' => 73.8, 'id' => 'CWE-807', 'description' => 'Reliance on Untrusted Inputs in a Security Decision'],
            ['position' => 11, 'score' => 73.1, 'id' => 'CWE-250', 'description' => 'Execution with Unnecessary Privileges'],
            ['position' => 12, 'score' => 70.1, 'id' => 'CWE-352', 'description' => 'Cross-Site Request Forgery (CSRF)'],
            ['position' => 13, 'score' => 69.3, 'id' => 'CWE-22', 'description' => 'Improper Limitation of a Pathname to a Restricted Directory (Path Traversal)'],
            ['position' => 14, 'score' => 68.5, 'id' => 'CWE-494', 'description' => 'Download of Code Without Integrity Check'],
            ['position' => 15, 'score' => 67.8, 'id' => 'CWE-863', 'description' => 'Incorrect Authorization'],
            ['position' => 16, 'score' => 66.0, 'id' => 'CWE-829', 'description' => 'Inclusion of Functionality from Untrusted Control Sphere'],
            ['position' => 17, 'score' => 65.5, 'id' => 'CWE-732', 'description' => 'Incorrect Permission Assignment for Critical Resource'],
            ['position' => 18, 'score' => 64.6, 'id' => 'CWE-676', 'description' => 'Use of Potentially Dangerous Function'],
            ['position' => 19, 'score' => 64.1, 'id' => 'CWE-327', 'description' => 'Use of a Broken or Risky Cryptographic Algorithm'],
            ['position' => 20, 'score' => 62.4, 'id' => 'CWE-131', 'description' => 'Incorrect Calculation of Buffer Size'],
            ['position' => 21, 'score' => 61.5, 'id' => 'CWE-307', 'description' => 'Improper Restriction of Excessive Authentication Attempts'],
            ['position' => 22, 'score' => 61.1, 'id' => 'CWE-601', 'description' => 'URL Redirection to Untrusted Site (Open Redirect)'],
            ['position' => 23, 'score' => 61.0, 'id' => 'CWE-134', 'description' => 'Uncontrolled Format String'],
            ['position' => 24, 'score' => 60.3, 'id' => 'CWE-190', 'description' => 'Integer Overflow or Wraparound'],
            ['position' => 25, 'score' => 59.9, 'id' => 'CWE-759', 'description' => 'Use of a One-Way Hash without a Salt']
        ];
    }
}
