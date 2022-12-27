<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Controller;

use App\Repository\ApplicationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class BokController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    private ApplicationRepository $applicationRepository;

    public function __construct(EntityManagerInterface $entityManager, ApplicationRepository $applicationRepository)
    {
        $this->entityManager = $entityManager;
        $this->applicationRepository = $applicationRepository;
    }

    #[Route('/bok', name: 'bok')]
    public function index(Request $request): Response
    {
        $applications = $this->applicationRepository->getAllUnreadApplications();

        return $this->render('Bok/index.html.twig', [
            'applications' => $applications,
        ]);
    }

}