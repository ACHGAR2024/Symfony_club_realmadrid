<?php
// src/Controller/ErrorController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    /**
     * @Route("/error/{statusCode}", name="error_page")
     */
    public function show(int $statusCode, KernelInterface $kernel): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_ANONYMOUSLY'); // Add this line to prevent a 500 error

        $template = sprintf('bundles/TwigBundle/Exception/%d.html.twig', $statusCode);
        $templatePath = $kernel->getProjectDir() . '/templates/' . $template;

        if (!file_exists($templatePath)) {
            $template = 'bundles/TwigBundle/Exception/error.html.twig';
        }

        return $this->render($template, ['status_code' => $statusCode]);
    }
}
