<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{

    #[Route('/user/add', name: 'app_user_add')]

    public function add
    (
        Request                $request,
        EntityManagerInterface $em
    ): Response
    {

        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Le collaborateur a bien été ajouté.');
            return $this->redirectToRoute('app_employe_index');
        }

        return $this->render('user/addUser.html.twig', [
            'form' => $form->createView(),
            'employe' => $user
        ]);
    }

}