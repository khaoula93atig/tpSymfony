<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Entity\PieceIdentite;
use App\Form\PersonneType;
use App\Form\PieceType;
use App\Repository\PersonneRepository;
use http\Env\Request;
use http\Message\Body;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route("/", name="personne.liste")
     */
    public function index()
    {
        // Récupérer le Repository
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $personnes = $repository->findAll();

        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }
    /**
     * @Route("/add/{nom}/{prenom}/{age}", name="personne.add")
     */
    public function addPersonne1($nom,$prenom,$age)
    {
        $doctrine = $this->getDoctrine();
        $manager=$doctrine->getManager();

        $personne=new Personne();
        $personne->setName($nom);
        $personne->setFirstname($prenom);
        $personne->setAge($age);

        $manager->persist($personne);
        $manager->flush();

        return $this->redirectToRoute('personne.liste');

    }
    /**
     * @Route("/per", name="personne.liste")
     */
    public function affiche()
    {
        $repository=$this->getDoctrine()->getRepository(Personne::class);
        $personnes=$repository->findAll();
        return $this->render('todo/index.html.twig', [
            'personnes'=>$personnes
        ]);
    }

    /**
     * @Route("/detail/{id}", name="personne.detail")
     */
    public function findPersonneById($id) {
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $personne = $repository->find($id);
        if ($personne) {
            return $this->render('todo/detail.html.twig', ['personne' => $personne]);
        } else {
            $this->addFlash('error', 'Personne innexistante');
            return $this->redirectToRoute('personne.liste');
        }

    }


    /**
     * @Route ("/delete/{id}",name="personne.delete")
     */
    public function delete(Personne $personne=null){

        if($personne){
            $manager= $this->getDoctrine()->getManager();
            $manager->remove($personne);
            $manager->flush();
        }
        else{
            $this->addFlash('error','le personne nexiste pas ');

        }
        return $this->redirectToRoute('personne.liste');
    }

    /**
     * @Route("/age/{min?0}/{max?0}",name="personne.find.age")
     */
    public function getPersonneByAge($min, $max) {
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $personnes = $repository->getPersonnesByIntervalAge($min,$max);
        return $this->render('todo/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }

    /**
     * @Route("/avgage/{min?0}/{max?0}",name="personne.find.avgage")
     */
    public function getAvgPersonneByAge($min, $max) {
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $personnes = $repository->getAvgAgePersonnesByIntervalAge($min,$max);
        //dd($stats);
        return $this->render('todo/index.html.twig',
            ['personnes' => $personnes,
        ]);
    }

    /**
     * @Route("/job/{min?0}/{max?0}/{jobname}",name="personne.find.job")
     */
    public function getAvgPersonneByAgeAndJobName($min, $max, $jobname) {
        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $personnes = $repository->getPersonnesByJobIntervalAge(0,0,$jobname);
        return $this->render('todo/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }
    
    /**
     * @Route("/edit/{id?0}", name="personne.edit")
     */
    public function addPersonne(\Symfony\Component\HttpFoundation\Request $request,Personne $personne = null) {
        if(!$personne)
            $personne = new Personne();
        $form = $this->createForm(PersonneType::class, $personne);
        $form->remove('createdAt');
        $form->remove('updatedAt');
        $form->remove('pieceIdentite');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $imageInfos = $form->get('image')->getData();
            if ($imageInfos){
                $imageName = $imageInfos->getClientOriginalName();
                $newImageName = md5(uniqid()) . $imageName;
                $imageInfos->move($this->getParameter('personne_directory'),
                    $newImageName);
                $personne->setPath('uploads/personne/' . $newImageName);
            }

            $req = $this->getDoctrine()->getManager();
            $req->persist($personne);
            $req->flush();
            return $this->redirectToRoute('personne.detail',['id' => $personne->getId()]);
        }
        return $this->render('todo/for.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/ajout/{id?0}", name="personne.ajout")
     */
    public function ajoutPersonne( \Symfony\Component\HttpFoundation\Request $request, Personne $personne = null) {
        if(!$personne)
            $personne = new Personne();
        $form = $this->createForm(PersonneType::class, $personne);
        $form->remove('createdAt');
        $form->remove('updatedAt');
        $form->remove('pieceIdentite');
        $form->handleRequest($request);
        if ($form->isSubmitted()){
            $req= $this->getDoctrine()->getManager();
            $req->persist($personne);
            $req->flush();
            $this->addFlash('success','ajout avec succssé ');
            return $this->redirectToRoute('personne.liste');
        }
        return $this->render('todo/for.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/update/{id}/{name}/{firstname}/{age}", name="personne.update")
     */
    public function updatePersonne1($name, $firstname, $age, Personne $personne = null) {
        if (!$personne) {
            $this->addFlash('error', 'Personne innexistante');
            return $this->redirectToRoute('personne.liste');
        }
        $doctrine = $this->getDoctrine();
        $manager = $doctrine->getManager();
        $personne->setFirstname($firstname);
        $personne->setName($name);
        $personne->setAge($age);
        $manager->persist($personne);
        $manager->flush();
        return $this->redirectToRoute('personne.liste');
    }
    /**
     * @Route ("/piece/{id}",name="personne.piece")
     */
   /* public function affichePiece($id,\Symfony\Component\HttpFoundation\Request $request )
    {

        $repository = $this->getDoctrine()->getRepository(Personne::class);
        $personne = $repository->find($id);
        $piece = $personne->getPieceIdentite();
        if ($piece) {
            return $this->render('todo/piece.html.twig', ['piece' => $piece]);
        } else {
            $piece = new PieceIdentite();
            $form = $this->createForm(PieceType::class, $piece);
            $form->remove('createdAt');
            $form->remove('updatedAt');
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $req = $this->getDoctrine()->getManager();
                $req->persist($piece);
                $personne->setPieceIdentite($piece);
                $req->persist($personne);
                $req->flush();
                return $this->redirectToRoute('personne.detail', ['id' => $personne->getId()]);
            }
            return $this->render('todo/formpiece.html.twig', [
                'form' => $form->createView()
            ]);
        }


    }*/

}
