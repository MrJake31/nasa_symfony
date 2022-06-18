<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request, ParameterBagInterface $params): Response
    {
        $service = $params->get('api');
        if (isset($_GET['date_img_of_the_day']) && !empty($_GET['date_img_of_the_day'])){
            $img_json = file_get_contents($service['url']."/planetary/apod?date=".$_GET['date_img_of_the_day']."&api_key=".$service['api-key']);
        }else{
            $img_json = file_get_contents($service['url']."/planetary/apod?api_key=".$service['api-key']);
        }
        $img = json_decode($img_json);

        $date = new \DateTime();
        $date_now = $date->format('Y-m-d');


        return $this->render('default/index.html.twig', [
            'date_now' => $date_now,
            'img' => $img,
            'controller_name' => 'DefaultController',
        ]);
    }
}
