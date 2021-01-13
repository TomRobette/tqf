<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuteurController extends AbstractController
{
    /**
     * @Route("/ajoutAuteur", name="ajoutAuteur")
     */
    public function ajoutAuteur(Request $request)
    {
        $auteur = new Auteur();
        $form = $this->createForm(ajoutAuteurType::class,$auteur);
        
        if ($request->isMethod('POST')){            
            $form -> handleRequest ($request);            
            if($form->isValid()){              
              $em = $this->getDoctrine()->getManager();              
              $em->persist($auteur);              
              $em->flush();        
            $this->addFlash('notice','Auteur ajouté'); 
           
            } 
            return $this->redirectToRoute('ajoutAuteur');
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
    
        $auteur = $repoAuteur->findBy(array(), array('id'=>'ASC'));
            
        return $this->render('auteur/liste.html.twig', [
            'auteur'=>$auteur
        ]);
    }
}
