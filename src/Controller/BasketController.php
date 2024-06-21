<?php

namespace App\Controller;

use App\Repository\ClubRepository;
use App\Repository\TeamRepository;
use App\Repository\MemberRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BasketController extends AbstractController
{
    #[Route('/basket', name: 'app_basket')]
    public function index(MemberRepository $memberRepository, TeamRepository $teamRepository, ClubRepository $clubRepository): Response
    {
        $members = $memberRepository->findBy(['team' => 9], ['id' => 'DESC']);
        $teams = $teamRepository->findBy(['id' => 9]);
        $clubs = $clubRepository->findBy(['id' => 2]);
        return $this->render('basket/index.html.twig', [
            'controller_name' => 'BasketController',
            'members' => $members,
            'teams' => $teams,
            'clubs' => $clubs,
        ]);
    }
}