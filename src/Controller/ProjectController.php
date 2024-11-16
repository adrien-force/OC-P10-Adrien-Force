<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectAddType;
use App\Form\ProjectEditType;
use App\Repository\ProjectRepository;
use App\Repository\StatusRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProjectController extends AbstractController
{
    #[Route('/project/', name: 'app_project_index')]
    public function index(ProjectRepository $projectRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $projects = $projectRepository->findAll();
        } else {
        $projects = $projectRepository->findByUser($this->getUser());
        }

        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
            'projects' => $projects
        ]);
    }

    #[Route('/project/show/{id}', name: 'app_project_show')]
    #[isGranted('view', subject: 'project')]
    public function show
    (
        StatusRepository  $statusRepository,
        Project               $project,
    ): Response
    {
        if (!$project ||
            !$statusRepository->findAll()) {
            return $this->redirectToRoute('app_project_index');
        }


        return $this->render('project/project.html.twig', [
            'controller_name' => 'ProjectController',
            'project' => $project,
            'status' => $statusRepository->findAll()
        ]);
    }

    #[Route('/project/remove/{id}', name: 'app_project_remove')]
    #[IsGranted('edit', subject: 'project')]
    public function remove
    (
        ProjectRepository $projectRepository,
        Project $project,
        EntityManagerInterface $em
    ): Response
    {
        if (!$project) {
            return $this->redirectToRoute('app_project_index');
        }

        //must delete all tasks before deleting the project because of the foreign key constraint
        foreach ($project->getTasks() as $task) {
            $em->remove($task);
        }

        $em->remove($project);
        $em->flush();
        return $this->redirectToRoute('app_project_index');
    }

    #[Route('/project/edit/{id}', name: 'app_project_edit')]
    #[IsGranted('edit', subject: 'project')]
    public function edit(
        ProjectRepository      $projectRepository,
        Project                    $project,
        EntityManagerInterface $em,
        Request                $request,
    ): Response {
        if (!$project) {
            throw $this->createNotFoundException('The project does not exist');
        }
        $form = $this->createForm(ProjectEditType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($project);
            $em->flush();

            return $this->redirectToRoute('app_project_show', ['id' => $project->getId()]);
        }
        return $this->render('project/edit.html.twig', [
            'form' => $form->createView(),
            'project' => $project,
        ]);
    }



    #[Route('/project/add', name: 'app_project_add')]
    #[IsGranted('add')]
    public function add
    (
        Request                $request,
        EntityManagerInterface $em,
    ): Response
    {
        $project = new Project();
        $form = $this->createForm(ProjectAddType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($project);
            $em->flush();
            return $this->redirectToRoute('app_project_index');
        }

        return $this->render('project/add.html.twig', [
            'form' => $form->createView(),
        ]);

    }
}
