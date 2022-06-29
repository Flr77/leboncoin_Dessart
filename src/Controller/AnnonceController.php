<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Annonce;
use App\Form\AddAnnonceType;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/add", name="app_add")
     */
    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        $annonce = new Annonce();
        $form = $this->createForm(AddAnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('annonce/add.html.twig', [
            'add' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/{id}", name="app_detail")
     */
    public function detail(EntityManagerInterface $entityManager, $id): Response
    {
        $annonce = $entityManager->getRepository(Annonce::class)->findOneById($id);

        return $this->render('annonce/detail.html.twig', [
            'detail' => $annonce
        ]);
    }

    /**
     * @Route("/update/{id}", name="app_update")
     */
    public function update(Request $request, EntityManagerInterface $entityManager, $id): Response
    {
        $annonce = $entityManager->getRepository(Annonce::class)->findOneById($id);

        $form = $this->createForm(AddAnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($annonce);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('annonce/add.html.twig', [
            'add' => $form->createView(),
        ]);
    }

     /**
     * @Route("/delete/{id}", name="app_delete")
     */
    public function delete(EntityManagerInterface $entityManager, $id): Response
    {
        $annonce = $entityManager->getRepository(Annonce::class)->findOneById($id);

        $entityManager->remove($annonce);
        $entityManager->flush();

        return $this->redirectToRoute('app_home');
    }
}
