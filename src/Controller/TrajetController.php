<?php

namespace App\Controller;

use App\Entity\Trajet;
use App\Entity\User;
use App\Form\TrajetType;
use App\Repository\TrajetRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
/**
 * @Route("/trajet")
 */
class TrajetController extends AbstractController
{
    /**
     * @Route("/", name="trajet_index", methods={"GET"})
     */
    public function index(TrajetRepository $trajetRepository): Response
    {
        return $this->render('trajet/index.html.twig', [
            'trajets' => $trajetRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="trajet_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $trajet = new Trajet();
        $form = $this->createForm(TrajetType::class, $trajet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($trajet);
            $entityManager->flush();

            return $this->redirectToRoute('trajet_index');
        }

        return $this->render('trajet/new.html.twig', [
            'trajet' => $trajet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="trajet_show", methods={"GET"})
     */
    public function show(Trajet $trajet): Response
    {
        return $this->render('trajet/show.html.twig', [
            'trajet' => $trajet,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="trajet_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Trajet $trajet): Response
    {
        $form = $this->createForm(TrajetType::class, $trajet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('trajet_index');
        }

        return $this->render('trajet/edit.html.twig', [
            'trajet' => $trajet,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="trajet_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Trajet $trajet): Response
    {
        if ($this->isCsrfTokenValid('delete'.$trajet->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($trajet);
            $entityManager->flush();
        }

        return $this->redirectToRoute('trajet_index');
    }

    /**
     * @Route("/{id}/join", name="trajet_join", methods={"GET"})
     */
    public function join(Trajet $trajet): Response
    {

        $user = $this->getUser();

        if ($user != $trajet->getConducteur()) {
            $trajet->addPassager($user);
        }

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->flush();

        return $this->redirectToRoute('trajet_show', ['id' => $trajet->getId()]);

    }

    /**
     * @Route("/{id}/leave", name="trajet_leave", methods={"GET"})
     */
    public function leave(Trajet $trajet): Response
    {

        $user = $this->getUser();

        $trajet->removePassager($user);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->flush();

        return $this->redirectToRoute('trajet_show', ['id' => $trajet->getId()]);
    }

    /**
     * @Route("/{id_trajet}/{id_user}/remove", name="trajet_remove_user", methods={"GET"})
     *
     * @ParamConverter("trajet", options={"mapping": {"id_trajet" : "id"}})
     * @ParamConverter("user", options={"mapping": {"id_user"   : "id"}})
     *
     * @Template()
     *
     */
    public function remove(Trajet $trajet, User $user): Response
    {

        $trajet->removePassager($user);

        $entityManager = $this->getDoctrine()->getManager();

        $entityManager->flush();

        return $this->redirectToRoute('trajet_show', ['id' => $trajet->getId()]);
    }
}
