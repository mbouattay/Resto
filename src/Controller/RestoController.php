<?php

namespace App\Controller;

use App\Entity\Resto;
use App\Form\RestoType;
use App\Repository\RestoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/resto')]
class RestoController extends AbstractController
{
    #[Route('/', name: 'app_resto_index', methods: ['GET'])]
    public function index(RestoRepository $restoRepository): Response
    {
        return $this->render('resto/index.html.twig', [
            'restos' => $restoRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_resto_new', methods: ['GET', 'POST'])]
    public function new(Request $request, RestoRepository $restoRepository): Response
    {
        $resto = new Resto();
        $form = $this->createForm(RestoType::class, $resto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $restoRepository->save($resto, true);

            return $this->redirectToRoute('app_resto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('resto/new.html.twig', [
            'resto' => $resto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_resto_show', methods: ['GET'])]
    public function show(Resto $resto): Response
    {
        return $this->render('resto/show.html.twig', [
            'resto' => $resto,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_resto_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Resto $resto, RestoRepository $restoRepository): Response
    {
        $form = $this->createForm(RestoType::class, $resto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $restoRepository->save($resto, true);

            return $this->redirectToRoute('app_resto_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('resto/edit.html.twig', [
            'resto' => $resto,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_resto_delete', methods: ['POST'])]
    public function delete(Request $request, Resto $resto, RestoRepository $restoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$resto->getId(), $request->request->get('_token'))) {
            $restoRepository->remove($resto, true);
        }

        return $this->redirectToRoute('app_resto_index', [], Response::HTTP_SEE_OTHER);
    }
}
