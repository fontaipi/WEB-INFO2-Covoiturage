<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TrajetController extends AbstractController
{
    /**
     * @Route("/trajet", name="trajet")
     */
    public function index()
    {
        return $this->render('trajet/index.html.twig');
    }

    /**
     * @Route("/trajet/new", name="new_trajet")
     */
    public function new()
    {
        return $this->render('trajet/new.html.twig');
    }
}
