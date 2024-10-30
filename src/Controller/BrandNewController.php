<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Routing\Attribute\Route;

class BrandNewController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function inex(): Response
    {

        return $this->render('brand_new/index.html.twig', [
            'controller_name' => 'BrandNewController',
        ]);
    }  

    #[Route('/gato', name: 'app_brand_new')]
    public function index(): JsonResponse
    {
        $json = ['gato' => "miau miau miau miau"];

        return new JsonResponse($json);

    }
    
}