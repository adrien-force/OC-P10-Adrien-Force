<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class UserController extends AbstractController
{

    #[Route('/users', name: 'app_user_list')]
    public function list(UserRepository $userRepository): Response
    {
        $users = $userRepository->findAll();
        return $this->render('user/listUser.html.twig', [
            'users' => $users
        ]);
    }


    #[Route('/user/add', name: 'app_user_add')]
    #[isGranted('edit')]
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
    #[isGranted('edit', subject: 'user')]
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

    #[Route('/user/delete/{id}', name: 'app_user_delete')]
    #[isGranted('edit', subject: 'user')]
    public function delete
    (
        User                   $user,
        EntityManagerInterface $em
    ): Response
    {
        $em->remove($user);
        $em->flush();
        $this->addFlash('success', 'Le collaborateur a bien été supprimé.');
        return $this->redirectToRoute('app_user_list');
    }

}