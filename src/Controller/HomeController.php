<?php

// src/Controller/HomeController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface; // Import EntityManagerInterface
use App\Entity\Club; // Import Club entity


class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $clubs = $this->entityManager->getRepository(Club::class)->findAll();

        return $this->render('home/index.html.twig', [
            'clubs' => $clubs,
            'controller_name' => 'HomeController',
        ]);



    }
}