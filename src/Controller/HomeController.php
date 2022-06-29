<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Annonce;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $annonces = $entityManager->getRepository(Annonce::class)->findAll();
        return $this->render('home/index.html.twig', [
            'annonces' => $annonces
        ]);
    }
}
