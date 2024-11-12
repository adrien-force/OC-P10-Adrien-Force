<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Enum\ContractTypeEnum;
use App\Enum\RoleEnum;
use App\Form\SignInType;
use App\Form\SignUpType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
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
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response {
        $form = $this->createForm(SignInType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $email = $data->getEmail();
            $plainPassword = $data->getPassword();

            $user = $em->getRepository(User::class)->findOneBy(['email' => $email]);

            if ($user && $passwordHasher->isPasswordValid($user, $plainPassword)) {
                return $this->redirectToRoute('app_project');
            }

            $this->addFlash('error', 'Email ou mot de passe incorrect');
        }

        return $this->render('index/signIn.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/signUp', name: 'signUp')]
    public function signUp(
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher
    ): Response {

        $newUser = new User();
        $newUser->setRole(RoleEnum::COLLABORATOR);
        $newUser->setActive(true);
        $newUser->setArrivalAt(new \DateTimeImmutable());
        $newUser->setContractType(ContractTypeEnum::CDI);

        $form = $this->createForm(SignUpType::class, $newUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hashedPassword = $passwordHasher->hashPassword($newUser, $newUser->getPassword());
            $newUser->setPassword($hashedPassword);

            $em->persist($newUser);
            $em->flush();

            return $this->redirectToRoute('app_project');
        }

        return $this->render('index/signUp.html.twig', [
            'form' => $form->createView(),
            'newUser' => $newUser
        ]);
    }
}
