<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Controller;

use App\Dictionary\ApplicationDictionary;
use App\Dictionary\InformationDictionary;
use App\Dictionary\StatusDictionary;
use App\Entity\Information;
use App\Form\UpdateStatusType;
use App\Provider\ApplicationProvider;
use App\Repository\InformationRepository;
use App\Services\Application\ReadApplication;
use App\Services\Application\UpdateStatus;
use App\Services\Information\PersistInformation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class BokController extends AbstractController
{
    private ApplicationProvider $applicationProvider;

    private ReadApplication $readApplication;

    private EntityManagerInterface $entityManager;

    private UpdateStatus $updateStatus;

    private InformationRepository $informationRepository;

    private PersistInformation $persistInformation;

    public function __construct(ApplicationProvider $applicationProvider, ReadApplication $readApplication, EntityManagerInterface $entityManager, UpdateStatus $updateStatus, InformationRepository $informationRepository, PersistInformation $persistInformation)
    {
        $this->applicationProvider = $applicationProvider;
        $this->entityManager = $entityManager;
        $this->readApplication = $readApplication;
        $this->updateStatus = $updateStatus;
        $this->informationRepository = $informationRepository;
        $this->persistInformation = $persistInformation;
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

        if($application->getUser() === null) {
            $application->setUser($this->getUser());
            $this->readApplication->updateData($application);

            $this->entityManager->flush();
        }

        $form = $this->createForm(UpdateStatusType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $status = $form->get(StatusDictionary::STATUS)->getData();
            $this->updateStatus->updateData($application, $status);

            $informationData = $form->get(InformationDictionary::INFORMATION)->getData();

            if($informationData !== null) {
                $information = $this->persistInformation->createInformation(
                    $informationData->getContent(),
                    $application,
                    $this->getUser()
                );

                $this->entityManager->persist($information);
            }

            $this->entityManager->flush();

            return $this->redirectToRoute('bok');
        }

        $comments = $this->informationRepository->getComments($id);

        return $this->render('Bok/Application/index.html.twig', [
            'application' => $application,
            'comments' => $comments,
            'form' => $form->createView(),
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