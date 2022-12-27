<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Provider;

use App\Entity\Application;
use App\Repository\ApplicationRepository;
use Doctrine\ORM\EntityManagerInterface;

class ApplicationProvider
{
    private EntityManagerInterface $entityManager;

    private ApplicationRepository $applicationRepository;

    public function __construct(EntityManagerInterface $entityManager, ApplicationRepository $applicationRepository)
    {
        $this->entityManager = $entityManager;
        $this->applicationRepository = $applicationRepository;
    }

    public function getDashboardData(): array
    {
        return $this->applicationRepository->getAllUnreadApplications();
    }

    public function getSingleData(int $id): Application
    {
        return $this->entityManager->getRepository(Application::class)->find($id);
    }

    public function listAll(): array
    {
        return $this->applicationRepository->findAllFromNewest();
    }

}