<?php
namespace App\Controller;

use App\Repository\ClubRepository;
use App\Repository\TeamRepository;
use App\Repository\MemberRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlayerController extends AbstractController
{
    #[Route('/player', name: 'app_player', methods: ['GET'])]
    public function player(MemberRepository $memberRepository, TeamRepository $teamRepository, ClubRepository $clubRepository): Response
    {
        $members = $memberRepository->findBy(['team' => 7], ['id' => 'DESC']);
        $teams = $teamRepository->findBy(['id' => 7]);
        $clubs = $clubRepository->findBy(['id' => 2]);

        return $this->render('player/player.html.twig', [
            'members' => $members,
            'teams' => $teams,
            'clubs' => $clubs,
        ]);
    }
}