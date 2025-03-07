<?php

namespace App\Controller;

use App\Entity\Goodie;
use App\Form\GoodieType;
use App\Repository\GoodieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/goodie')]
final class GoodieController extends AbstractController
{
    #[Route(name: 'app_goodie_index', methods: ['GET'])]
    public function index(GoodieRepository $goodieRepository): Response
    {
        return $this->render('goodie/index.html.twig', [
            'goodies' => $goodieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_goodie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $goodie = new Goodie();
        $form = $this->createForm(GoodieType::class, $goodie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($goodie);
            $entityManager->flush();

            return $this->redirectToRoute('app_goodie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('goodie/new.html.twig', [
            'goodie' => $goodie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_goodie_show', methods: ['GET'])]
    public function show(Goodie $goodie): Response
    {
        return $this->render('goodie/show.html.twig', [
            'goodie' => $goodie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_goodie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Goodie $goodie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GoodieType::class, $goodie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_goodie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('goodie/edit.html.twig', [
            'goodie' => $goodie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_goodie_delete', methods: ['POST'])]
    public function delete(Request $request, Goodie $goodie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$goodie->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($goodie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_goodie_index', [], Response::HTTP_SEE_OTHER);
    }
}
