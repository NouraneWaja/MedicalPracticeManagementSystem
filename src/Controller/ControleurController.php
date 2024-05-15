<?php

namespace App\Controller;

use App\Entity\Analyse;
use App\Repository\AnalyseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class ControleurController extends AbstractController
{
    #[Route('/', name: 'app_controleur')]
    public function index(): Response
    {
        return $this->render('controleur/home.html.twig', [
            'controller_name' => 'ControleurController',
        ]);
    }

    #[Route('/acceuil', name: 'app_dashbord')]
    public function acceuil(): Response
    {
        return $this->render('controleur/index.html.twig', [
            'controller_name' => 'ControleurController',
        ]);
    }
    #[Route('/analyse', name: 'app_analyse_index', methods: ['GET'])]
    public function index1(AnalyseRepository $analyseRepository): Response
    {
        return $this->render('analyse/index.html.twig', [
            'analyses' => $analyseRepository->findAll(),
        ]);
    }

    #[Route("/analyse/{id}/change-status", name:"app_analyse_change_status", methods:["POST"])]
    public function changeStatus(Analyse $analyse, EntityManagerInterface $entityManager): Response
    {
        $newStatus = !$analyse->isStatut(); // Bascule le statut actuel

        $analyse->setStatut($newStatus);

        $entityManager->persist($analyse);
        $entityManager->flush();

        // Redirection vers une page de confirmation ou autre
        return $this->redirectToRoute('app_analyse_index');
    }
}
