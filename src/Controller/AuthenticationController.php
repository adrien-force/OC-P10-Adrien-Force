<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Enum\ContractTypeEnum;
use App\Form\SignUpType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthenticationController extends AbstractController
{
    #[Route('/authentication')]
    public function index(): Response
    {
        return $this->render('authentication/index.html.twig');
    }

    #[Route('/signIn', name: 'app_signIn')]
    public function signIn(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher,
        AuthenticationUtils $authenticationUtils
    ): Response {

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('index/signIn.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    #[Route('/signUp', name: 'app_signUp')]
    public function signUp(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response {

        $newUser = new User();
        $newUser->setArrivalAt(new \DateTimeImmutable());
        $newUser->setContractType(ContractTypeEnum::CDI);

        $form = $this->createForm(SignUpType::class, $newUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword($newUser, $newUser->getPassword());
            $newUser->setPassword($hashedPassword);
            $newUser->addRole('ROLE_USER');

            $em->persist($newUser);
            $em->flush();

            return $this->redirectToRoute('app_project_index');
        }

        return $this->render('index/signUp.html.twig', [
            'form' => $form->createView(),
            'newUser' => $newUser
        ]);
    }
}
