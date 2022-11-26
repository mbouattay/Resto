<?php

namespace App\Controller;

use App\Entity\Commenter;
use App\Form\CommenterType;
use App\Repository\CommenterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commenter')]
class CommenterController extends AbstractController
{
    #[Route('/', name: 'app_commenter_index', methods: ['GET'])]
    public function index(CommenterRepository $commenterRepository): Response
    {
        return $this->render('commenter/index.html.twig', [
            'commenters' => $commenterRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_commenter_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommenterRepository $commenterRepository): Response
    {
        $commenter = new Commenter();
        $form = $this->createForm(CommenterType::class, $commenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commenterRepository->save($commenter, true);

            return $this->redirectToRoute('app_commenter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commenter/new.html.twig', [
            'commenter' => $commenter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commenter_show', methods: ['GET'])]
    public function show(Commenter $commenter): Response
    {
        return $this->render('commenter/show.html.twig', [
            'commenter' => $commenter,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_commenter_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commenter $commenter, CommenterRepository $commenterRepository): Response
    {
        $form = $this->createForm(CommenterType::class, $commenter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commenterRepository->save($commenter, true);

            return $this->redirectToRoute('app_commenter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commenter/edit.html.twig', [
            'commenter' => $commenter,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commenter_delete', methods: ['POST'])]
    public function delete(Request $request, Commenter $commenter, CommenterRepository $commenterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commenter->getId(), $request->request->get('_token'))) {
            $commenterRepository->remove($commenter, true);
        }

        return $this->redirectToRoute('app_commenter_index', [], Response::HTTP_SEE_OTHER);
    }
}
