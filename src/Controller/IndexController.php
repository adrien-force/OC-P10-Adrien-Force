<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\SignInType;
use App\Form\SignUpType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig');
    }

    #[Route('/signIn', name: 'signIn')]

    public function signIn(
        Request                $request
    ): Response
    {

        $form = $this->createForm(SignInType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('app_project');
        }

        return $this->render('index/signIn.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/signUp', name: 'signUp')]
    public function signUp(
        Request                $request,
        EntityManagerInterface $em
    ): Response
    {
        $newUser = new User();

        $form = $this->createForm(SignUpType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($newUser);
            $em->flush();
            return $this->redirectToRoute('app_project');
        }

        return $this->render('index/signUp.html.twig',
            [
                'form' => $form->createView(),
            ]);
    }
}
