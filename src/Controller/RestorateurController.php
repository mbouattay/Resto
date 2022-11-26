<?php

namespace App\Controller;

use App\Entity\Restorateur;
use App\Form\RestorateurType;
use App\Repository\RestorateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/restorateur')]
class RestorateurController extends AbstractController
{
    #[Route('/', name: 'app_restorateur_index', methods: ['GET'])]
    public function index(RestorateurRepository $restorateurRepository): Response
    {
        return $this->render('restorateur/index.html.twig', [
            'restorateurs' => $restorateurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_restorateur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RestorateurRepository $restorateurRepository): Response
    {
        $restorateur = new Restorateur();
        $form = $this->createForm(RestorateurType::class, $restorateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $restorateurRepository->save($restorateur, true);

            return $this->redirectToRoute('app_restorateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('restorateur/new.html.twig', [
            'restorateur' => $restorateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_restorateur_show', methods: ['GET'])]
    public function show(Restorateur $restorateur): Response
    {
        return $this->render('restorateur/show.html.twig', [
            'restorateur' => $restorateur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_restorateur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Restorateur $restorateur, RestorateurRepository $restorateurRepository): Response
    {
        $form = $this->createForm(RestorateurType::class, $restorateur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $restorateurRepository->save($restorateur, true);

            return $this->redirectToRoute('app_restorateur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('restorateur/edit.html.twig', [
            'restorateur' => $restorateur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_restorateur_delete', methods: ['POST'])]
    public function delete(Request $request, Restorateur $restorateur, RestorateurRepository $restorateurRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$restorateur->getId(), $request->request->get('_token'))) {
            $restorateurRepository->remove($restorateur, true);
        }

        return $this->redirectToRoute('app_restorateur_index', [], Response::HTTP_SEE_OTHER);
    }
}
