<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{

    #[Route('/user/add', name: 'app_user_add')]

    public function add
    (
        Request                $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response
    {

        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);
            $user->setRoles([$form->get('roles')->getData()]);
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Le collaborateur a bien été ajouté.');
            return $this->redirectToRoute('app_user_add');
        }

        return $this->render('user/addUser.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    #[Route('/user/edit/{id}', name: 'app_user_edit')]
    public function edit
    (
        User                   $user,
        Request                $request,
        EntityManagerInterface $em
    ): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->remove('password');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles([$form->get('roles')->getData()]);
            $em->flush();
            $this->addFlash('success', 'Le collaborateur a bien été modifié.');
            return $this->redirectToRoute('app_user_edit', ['id' => $user->getId()]);
        }

        return $this->render('user/editUser.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

}