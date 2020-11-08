<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FirstController extends AbstractController
{
    /**
     * @Route("/first/{name}/{age<[1-9]\d?>}/{section<GL|RT>}/{_locale<fr|en>}/{_format?html}",
     *      name="first" )
     */
    public function index($name,$age,$section)
    {

        return $this->render('first/index.html.twig',['khaoula'=>$name,'26'=>$age,'si'=>$section]);

    }
}
