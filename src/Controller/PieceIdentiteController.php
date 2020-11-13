<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Entity\PieceIdentite;
use App\Form\PieceIdentiteType;
use App\Form\PieceType;
use App\Repository\PieceIdentiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



/**
 *Class PieceIdentiteController
 * @package App\Controller
 * @Route("/pieceidentite")
 */
class PieceIdentiteController extends AbstractController
{
    /**
     * @Route("/pieceidentite", name="piece_identite")
     */
    public function index()
    {
        return $this->render('piece_identite/index.html.twig', [
            'controller_name' => 'PieceIdentiteController',
        ]);
    }
    /**
     * @Route("/{personne}/{id?0}", name="piece_identite.edit")
     */
    public function editPieceIdentite(Personne $personne = null, $id, Request $request)
    {
        if(!$personne){
            return $this->redirectToRoute('personne.liste');
        }else{
            if($id) {
                $repository = $this->getDoctrine()->getRepository(PieceIdentite::class);
                $pi = $repository->find($id);
                if (!$pi) {
                    $pi = new PieceIdentite();
                }
            }else{
                    $pi=new PieceIdentite();
            }
            $form = $this->createForm(PieceIdentiteType::class,$pi);
            $form->remove('updatedAt');
            $form->remove('createdAt');
            $form->remove('personne');
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $pi->setPersonne($personne);
                $em = $this->getDoctrine()->getManager();
                $em->persist($pi);
                $em->flush();
                return $this->redirectToRoute('personne.detail', [
                    'id' => $personne->getId()
                ]);
            } else {
                // On veut juste afficher le formulaire
                return $this->render('piece_identite/edit.html.twig', [
                    'form' => $form->createView()
                ]);
            }

        }
    }
}
