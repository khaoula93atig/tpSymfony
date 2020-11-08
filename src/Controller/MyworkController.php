<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MyworkController extends AbstractController
{
    /**
     * @Route("/my/{name}", name="mywork")
     */
    public function index($name)
    {
        return $this->render('mywork/index.html.twig', [
            'controller_name' => 'MyworkController',
        ]);
    }
}
