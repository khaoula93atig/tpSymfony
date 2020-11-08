<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PersonnesController extends AbstractController
{
    /**
     * @Route("/personnes", name="personnes")
     */
    public function index()
    {
        $personnes= [
            array('nom'=>'Atig','prenom'=>'khaoula','age'=>27),
            array('nom'=>'Atig','prenom'=>'khaoula','age'=>27),
            array('nom'=>'Atig','prenom'=>'khaoula','age'=>27),
            array('nom'=>'Atig','prenom'=>'khaoula','age'=>27),


        ];
        return $this->render('personnes/index.html.twig', ['personnes'=>$personnes
        ]);
    }
}
