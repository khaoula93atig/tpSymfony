<?php

namespace App\Controller;

use App\Form\ExerciceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormualaireController extends AbstractController
{
    /**
     * @Route("/first", name="formualaire")
     */
    public function first()
    {
        $response =new Response();
        $response->sendContent()('<h1> cc forma </h1>');
        return $response;
    }
    /**
     * @Route("/form", name="form.test")
     */
    public function showform(Request $request)
    {
        $form=$this->createForm(ExerciceType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            dd($form->getData());

        }else{
            return $this->render('test/form.html.twig', [
                'form' => $form->createView()
            ]);
        }

    }
}
