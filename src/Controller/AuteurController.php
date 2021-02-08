<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use App\Entity\Fichier;
use App\Entity\Auteur;
use App\Form\AjoutAuteurType;
use App\Form\ModifAuteurType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AuteurController extends AbstractController
{
    /**
     * @Route("/ajoutAuteur", name="ajoutAuteur")
     */
    public function ajoutAuteur(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $auteur = new Auteur();
        $form = $this->createForm(ajoutAuteurType::class,$auteur);
        if ($request->isMethod('POST')){           
            $form->handleRequest($request);            
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($auteur);
                $em->flush();
                $this->addFlash('notice','Auteur ajouté');
                return $this->redirectToRoute('accueil');        
            }   
          }
        return $this->render('auteur/ajout.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
    * @Route("/listeAuteurs", name="listeAuteurs")
    */
    public function listeAuteurs(Request $request)
    {
        $em = $this->getDoctrine();
        $repoAuteur = $em->getRepository(Auteur::class);

        if($request->get('supp')!=null){
            $auteur = $repoAuteur->find($request->get('supp'));
            if($auteur!=null){
                $em->getManager()->remove($auteur);
                $em->getManager()->flush();
            }
            $this->redirectToRoute('listeAuteurs');
        }
    
        $char = null;
        if($request->get('char')!=null){
            $char = $request->get('char');
            $auteur = $repoAuteur->findBy(array('caractere' => $char), array('nom'=>'ASC'));
        }else{
            $auteur = $repoAuteur->findBy(array(), array('nom'=>'ASC'));
        }
            
        return $this->render('auteur/liste.html.twig', [
            'auteur'=>$auteur,
            'char'=>$char
        ]);
    }

    /**
     * @Route("/auteur/{id}", name="auteur", requirements={"id"="\d+"})
     */
    public function auteur(int $id, Request $request)
    {
        $em = $this->getDoctrine();
        $repoAut = $em->getRepository(Auteur::class);
        $auteur = $repoAut->find($id);

        if($auteur==null){
            $this->addFlash('notice','Cette page n\'existe pas');
            return $this->redirectToRoute('accueil');   
        }

        return $this->render('auteur/page.html.twig', [               
            'auteur'=>$auteur
        ]);
    }

    
     /**
     * @Route("/modifAuteur/{id}", name="modifAuteur", requirements={"id"="\d+"})
     */
    public function modifAuteur(int $id, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine();
        $repoAuteur = $em->getRepository(Auteur::class);
        $auteur = $repoAuteur->find($id);

        if($auteur==null){
            $this->addFlash('notice','Cette page n\'existe pas');
            return $this->redirectToRoute('listeAuteurs');   
        }

        $form = $this->createForm(ModifAuteurType::class,$auteur);

        if ($request->isMethod('POST')) {            
            $form->handleRequest($request);            
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($auteur);
                $em->flush();
                $this->addFlash('notice','Auteur modifié');
                return $this->redirectToRoute('listeAuteurs');        
            }          
        } 

        return $this->render('auteur/modif.html.twig', [            
            'form'=>$form->createView()        
        ]);
    }
}
