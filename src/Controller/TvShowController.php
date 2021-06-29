<?php

namespace App\Controller;

use App\Entity\TvShow;
use App\Form\TvShowType;
use App\Repository\TvShowRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tv/show")
 */
class TvShowController extends AbstractController
{
    /**
     * @Route("/", name="tv_show_list", methods={"GET"})
     */
    public function index(TvShowRepository $tvShowRepository): Response
    {
        return $this->render('tv_show/index.html.twig', [
            'tv_shows' => $tvShowRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="tv_show_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $tvShow = new TvShow();
        $form = $this->createForm(TvShowType::class, $tvShow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tvShow);
            $entityManager->flush();

            return $this->redirectToRoute('tv_show_index');
        }

        return $this->render('tv_show/new.html.twig', [
            'tv_show' => $tvShow,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tv_show_show", methods={"GET"})
     */
    public function show(TvShow $tvShow): Response
    {
        return $this->render('tv_show/show.html.twig', [
            'tv_show' => $tvShow,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="tv_show_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TvShow $tvShow): Response
    {
        $form = $this->createForm(TvShowType::class, $tvShow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tv_show_index');
        }

        return $this->render('tv_show/edit.html.twig', [
            'tv_show' => $tvShow,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="tv_show_delete", methods={"POST"})
     */
    public function delete(Request $request, TvShow $tvShow): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tvShow->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($tvShow);
            $entityManager->flush();
        }

        return $this->redirectToRoute('tv_show_index');
    }
}
