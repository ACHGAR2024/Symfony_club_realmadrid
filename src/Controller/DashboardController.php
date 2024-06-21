<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface; // Import EntityManagerInterface
use App\Entity\Club; // Import Club entity

class DashboardController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $clubs = $this->entityManager->getRepository(Club::class)->findAll();
        return $this->render('dashboard/index.html.twig', [
            'clubs' => $clubs,
            'controller_name' => 'DashboardController',
        ]);
    }
}