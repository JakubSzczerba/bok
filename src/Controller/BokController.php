<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Application;
use App\Provider\ApplicationProvider;
use App\Repository\ApplicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class BokController extends AbstractController
{
    private ApplicationProvider $applicationProvider;

    private EntityManagerInterface $entityManager;

    public function __construct(ApplicationProvider $applicationProvider, EntityManagerInterface $entityManager)
    {
        $this->applicationProvider = $applicationProvider;
        $this->entityManager = $entityManager;
    }

    #[Route('/bok', name: 'bok')]
    public function index(Request $request): Response
    {
        $applications = $this->applicationProvider->getDashboardData();

        return $this->render('Bok/index.html.twig', [
            'applications' => $applications,
        ]);
    }

    #[Route('/bok/application/{id}', name: 'single_application')]
    public function singleApplication(Request $request, int $id): Response
    {
        $application = $this->applicationProvider->getSingleData($id);
        $application->setUser($this->getUser());
        $application->setIsRead(true);
        $application->setDateRead(new \DateTime());

        $this->entityManager->flush();

        return $this->render('Bok/Application/index.html.twig', [
            'application' => $application,
        ]);
    }

    #[Route('/bok/list', name: 'list_application')]
    public function listApplications(Request $request): Response
    {
        $applications = $this->applicationProvider->listAll();

        return $this->render('Bok/Application/list.html.twig', [
            'applications' => $applications,
        ]);
    }

}