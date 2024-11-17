<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig');
    }

    #[Route('/mailtest', name: 'app_mail')]
    public function testRenderMail(): Response
    {
        $user = new class {
            public function getEmail(): string
            {
                return 'email@test.com';
            }
        };

        $authCode = '123456';

        return $this->render('email/two_factor_auth_code.html.twig', [
            'user' => $user,
            'authCode' => $authCode
        ]);
    }
}
