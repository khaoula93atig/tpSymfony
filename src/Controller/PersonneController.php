<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personne", name="personne")
     */
    public function index()
    {
        $tableau=[
            array('nom'=>'Atig','prenom'=>'khaoula','age'=>27),
            array('nom'=>'lala','prenom'=>'lola','age'=>27),
            array('nom'=>'hasna','prenom'=>'thameur','age'=>27)
        ];
        return $this->render('personne/index.html.twig', [
            'tableau'=>$tableau
        ]);
    }
    /**
     * @Route("/layout", name="base.layout")
     */
    public function test(){
        return $this->render('personne/test.html.twig');
    }

    /**
     * @Route("/page", name="page")
     */
    public function page(){
        return $this->render('personne/page.html.twig');
    }
    /**
    * @Route("/base", name="base")
    */
        public function base(){
            return $this->render('base.html.twig');
        }
}
