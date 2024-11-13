<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    #[Route('/access-denied', name: 'access_denied')]
    public function accessDenied(): Response
    {
        return $this->render('error/access_denied.html.twig');
    }

    #[Route('/error/{code}', name: 'error')]
    public function show(?int $code): Response
    {
        return $this->render('error/error.html.twig', ['code' => $code]);
    }
}