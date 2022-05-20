<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestformController extends AbstractController
{
    #[Route('/testform', name: 'app_testform')]
    public function index(): Response
    {
        return $this->render('testform/index.html.twig', [
            'controller_name' => 'TestformController',
        ]);
    }
}
