<?php
// src/Controller/NewclubController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;

class NewclubController extends AbstractController
{
    #[Route('/newclub', name: 'app_newclub')]
    public function index(): Response
    {
        // Récupération du contenu XML du flux RSS
        $rssFeedUrl = 'https://e00-marca.uecdn.es/rss/en/football/real-madrid.xml';
        $httpClient = HttpClient::create();
        $response = $httpClient->request('GET', $rssFeedUrl);

        // Vérification de la réponse
        if ($response->getStatusCode() === 200) {
            // Conversion du contenu XML en objet SimpleXMLElement
            $xmlContent = $response->getContent();
            $rss = new \SimpleXMLElement($xmlContent, LIBXML_NOCDATA);
        } else {
            // Gestion de l'erreur si le flux RSS ne peut pas être récupéré
            throw new \Exception('Unable to fetch RSS feed.');
        }

        // Envoi des données à la vue Twig
        return $this->render('newclub/index.html.twig', [
            'rss' => $rss,
        ]);
    }
}
