<?php

/*
 * This file was created by Jakub Szczerba
 * Contact: https://www.linkedin.com/in/jakub-szczerba-3492751b4/
*/

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class BokController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/bok/dashboard', name: 'bok_dashboard')]
    public function index(Request $request): Response
    {
        return $this->render('Bok/index.html.twig', []);
    }

    #[Route('/bok', name: 'bok')]
    public function bok(Request $request): Response
    {
        return $this->render('Bok/index.html.twig', []);
    }

}