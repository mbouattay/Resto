<?php

namespace App\Controller;

use App\Entity\Clinet;
use App\Form\ClinetType;
use App\Repository\ClinetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/clinet')]
class ClinetController extends AbstractController
{
    #[Route('/', name: 'app_clinet_index', methods: ['GET'])]
    public function index(ClinetRepository $clinetRepository): Response
    {
        return $this->render('clinet/index.html.twig', [
            'clinets' => $clinetRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_clinet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ClinetRepository $clinetRepository): Response
    {
        $clinet = new Clinet();
        $form = $this->createForm(ClinetType::class, $clinet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clinetRepository->save($clinet, true);

            return $this->redirectToRoute('app_clinet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('clinet/new.html.twig', [
            'clinet' => $clinet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_clinet_show', methods: ['GET'])]
    public function show(Clinet $clinet): Response
    {
        return $this->render('clinet/show.html.twig', [
            'clinet' => $clinet,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_clinet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Clinet $clinet, ClinetRepository $clinetRepository): Response
    {
        $form = $this->createForm(ClinetType::class, $clinet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $clinetRepository->save($clinet, true);

            return $this->redirectToRoute('app_clinet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('clinet/edit.html.twig', [
            'clinet' => $clinet,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_clinet_delete', methods: ['POST'])]
    public function delete(Request $request, Clinet $clinet, ClinetRepository $clinetRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$clinet->getId(), $request->request->get('_token'))) {
            $clinetRepository->remove($clinet, true);
        }

        return $this->redirectToRoute('app_clinet_index', [], Response::HTTP_SEE_OTHER);
    }
}
