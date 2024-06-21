<?php
// src/Controller/MessageController.php
namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class MessageController extends AbstractController
{
    #[Route('/messages', name: 'app_messages', methods: ['GET', 'POST'])]
    public function index(MessageRepository $messageRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $messages = $messageRepository->findBy([], ['id' => 'DESC']);

        return $this->render('messages/index.html.twig', [
            'messages' => $messages,
        ]);
    }

    #[Route('/message/delete/{id}', name: 'message_delete', methods: ['POST'])]
    public function delete(Request $request, Message $message, EntityManagerInterface $em, CsrfTokenManagerInterface $csrfTokenManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $submittedToken = $request->request->get('_token');

        if ($this->isCsrfTokenValid('delete-message', $submittedToken)) {
            $em->remove($message);
            $em->flush();

            $this->addFlash('success', 'Le message a été supprimé avec succès.');
        }

        return $this->redirectToRoute('app_messages');
    }

}