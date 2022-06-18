<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/asteroid")
 */
class AsteroidController extends AbstractController
{
    /**
     * @Route("/", name="index_asteroide")
     */
    public function index(Request $request, ParameterBagInterface $params): Response
    {
        $service = $params->get('api');
        $asteroid_data = file_get_contents($service['url']."/neo/rest/v1/feed?start_date=2022-06-05&api_key=".$service['api-key']);
        $asteroids = json_decode($asteroid_data);

        foreach ($asteroids->near_earth_objects as $key => $asteroid){
            $all_asteroids[$key] = $asteroid;
        }
        dump($all_asteroids);
        //die();
        return $this->render('asteroid/index.html.twig', [
            'asteroids' => $all_asteroids,
        ]);
    }
}
