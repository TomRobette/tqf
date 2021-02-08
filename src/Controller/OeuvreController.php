<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use App\Entity\Fichier;
use App\Entity\Oeuvre;
use App\Entity\Genre;
use App\Form\AjoutOeuvreType;
use App\Form\ModifOeuvreType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class OeuvreController extends AbstractController
{
    /**
     * @Route("/ajoutOeuvre", name="ajoutOeuvre")
     */
    public function ajoutOeuvre(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $oeuvre = new Oeuvre();
        $form = $this->createForm(AjoutOeuvreType::class,$oeuvre);
        if ($request->isMethod('POST')){           
            $form->handleRequest($request);            
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($oeuvre);
                $em->flush();
                $this->addFlash('notice','Oeuvre ajouté');
                return $this->redirectToRoute('accueil');        
            }   
          }
        return $this->render('oeuvre/ajout.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
    * @Route("/listeOeuvres", name="listeOeuvres")
    */
    public function listeOeuvres(Request $request)
    {
        $em = $this->getDoctrine();
        $repoOeuvre = $em->getRepository(Oeuvre::class);

        if($request->get('supp')!=null){
            $oeuvre = $repoOeuvre->find($request->get('supp'));
            if($oeuvre!=null){
                $em->getManager()->remove($oeuvre);
                $em->getManager()->flush();
            }
            $this->redirectToRoute('listeOeuvres');
        }
        $char = null;
        if($request->get('char')!=null){
            $char = $request->get('char');
            $oeuvre = $repoOeuvre->findBy(array('caractere' => $char), array('titre'=>'ASC'));
        }else{
            $oeuvre = $repoOeuvre->findBy(array(), array('titre'=>'ASC'));
        }
            
        return $this->render('oeuvre/liste.html.twig', [
            'oeuvre'=>$oeuvre,
            'char'=> $char
        ]);
    }

    /**
    * @Route("/listeLivresPhoto", name="listeLivresPhoto")
    */
    public function listeLivresPhoto(Request $request)
    {
        $em = $this->getDoctrine();
        $repoOeuvre = $em->getRepository(Oeuvre::class);

        if($request->get('supp')!=null){
            $oeuvre = $repoOeuvre->find($request->get('supp'));
            if($oeuvre!=null){
                $em->getManager()->remove($oeuvre);
                $em->getManager()->flush();
            }
            $this->redirectToRoute('listeOeuvres');
        }
        $char = null;
        $repoGenre = $em->getRepository(Genre::class);
        $genre = $repoGenre->findBy(array('libelle' => 'Livre Photo'), array());
        if($request->get('char')!=null){
            $char = $request->get('char');
            $oeuvre = $repoOeuvre->findBy(array('genre' => $genre, 'caractere' => $char), array('titre'=>'ASC'));
        }else{
            $oeuvre = $repoOeuvre->findBy(array('genre' => $genre), array('titre'=>'ASC'));
        }
            
        return $this->render('oeuvre/listePhoto.html.twig', [
            'oeuvre'=>$oeuvre,
            'char'=> $char
        ]);
    }

    /**
     * @Route("/oeuvre/{id}", name="oeuvre", requirements={"id"="\d+"})
     */
    public function oeuvre(int $id, Request $request)
    {
        $em = $this->getDoctrine();
        $repoOeuvre = $em->getRepository(Oeuvre::class);
        $oeuvre = $repoOeuvre->find($id);

        if($oeuvre==null){
            $this->addFlash('notice','Cette page n\'existe pas');
            return $this->redirectToRoute('accueil');   
        }

        return $this->render('oeuvre/page.html.twig', [               
            'oeuvre'=>$oeuvre,
        ]);
    }

    /**
     * @Route("/modifOeuvre/{id}", name="modifOeuvre", requirements={"id"="\d+"})
     */
    public function modifOeuvre(int $id, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine();
        $repoOeuvre = $em->getRepository(Oeuvre::class);
        $oeuvre = $repoOeuvre->find($id);

        if($oeuvre==null){
            $this->addFlash('notice','Cette page n\'existe pas');
            return $this->redirectToRoute('listeOeuvres');   
        }

        $form = $this->createForm(ModifOeuvreType::class,$oeuvre);

        if ($request->isMethod('POST')) {            
            $form->handleRequest($request);            
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($oeuvre);
                $em->flush();
                $this->addFlash('notice','Oeuvre modifiée');
                return $this->redirectToRoute('listeOeuvres');        
            }          
        } 

        return $this->render('oeuvre/modif.html.twig', [            
            'form'=>$form->createView()        
        ]);
    }
}
