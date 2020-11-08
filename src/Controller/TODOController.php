<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TODOController extends AbstractController
{
    /**
     * @Route("/todo", name="todo")
     */
    public function index(Request $request)
    {
        $session = $request->getSession();
        if(! $session->has('tab')) {

            $tab=array('achat' =>'acheté cle usb','cours' =>'finaliser mon cours','correction' =>'corriger mes examens');

            $this->addFlash('info','la liste des todos a été initialisée avec succssées');
            $session->set('tab',$tab);
        }

        return $this->render('todo/index.html.twig');
    }

    /**
     * @Route("/add/{title}/{content}",
     * name="todo.add"
     * )
     */
    public function addTodo($title, $content, Request $request) {
        /*
         * 1- Vérifier l'existance de la session
         *    Si non Je vais déclencher un message d'erreur
         *    Si oui
         *      2- Je vérifie si la clé du todo existe ou pas
         *          Si existe Je vais déclencher un message d'erreur
         *          Si non
         *              Ajoute le todo
         *              Créer un message de succés
         * 3- je redirige vers l'index
         */
        $session = $request->getSession();
        if (! $session->has('tab')) {
            $this->addFlash('error', "Session non encore initialisée");
        } else {
            $tab = $session->get('mesTodos');
            if (isset($tab[$title])) {
                $this->addFlash('error', "le todo de clé $title existe déjà :(");
            } else  {
                $tab[$title] = $content;
                $session->set('tab', $tab);
                $this->addFlash('success', "Le todo $title a été ajouté avec succès");
            }
        }
        return $this->redirectToRoute('todo');
    }
    /**
     * @Route ("todo/delete" , name="todo.delete")
     */
    /*public function deleteTODO(Request $reque)
    {
        $session =$reque->getSession();
        if(in_array("achat", $tab) ) {
            $this->addFlash('erreur','pas de mise a jour');
        }
        else{
            unset($tab['achat']);
            $session->set('tab',$tab);
            $this->addFlash('successée','ajout avec succsses');
            return $this->redirectToRoute('todo');
        }

        return $this->render('todo/index.html.twig', [
            'controller_name' => 'TODOController',
        ] );

    }*/



}
