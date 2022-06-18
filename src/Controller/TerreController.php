<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/earth")
 */
class TerreController extends AbstractController
{
    /**
     * @Route("/", name="index_terre")
     */
    public function index(): Response
    {
        return $this->render('terre/index.html.twig', [
            'controller_name' => 'TerreController',
        ]);
    }
}
