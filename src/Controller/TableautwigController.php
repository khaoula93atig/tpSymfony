<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TableautwigController extends AbstractController
{
    /**
     * @Route("/tableautwig/{taille?5<[1-9]\d*}", name="tableautwig")
     */
    public function index($taille)
    {
        $tableau=array();
        for ($i=0; $i<$taille;$i++)
            $tableau[$i]=rand(0,20);
        return $this->render('tableautwig/index.html.twig', [
            'tableau' => $tableau,
        ]);
    }
}
