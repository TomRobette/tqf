<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Apropos;
use App\Form\AjoutAproposType;
use App\Form\ModifAproposType;

class StaticController extends AbstractController
{
    /**
     * @Route("/apropos", name="apropos")
     */
    public function apropos()
    {
        $em = $this->getDoctrine();
        $repoApropos = $em->getRepository(Apropos::class);
    
        $apropos = $repoApropos->findBy(array(), array('id'=>'ASC'));
        
        return $this->render('static/apropos.html.twig', [
            'apropos'=>$apropos
        ]);
    }

    /**
     * @Route("/modifApropos", name="modifApropos")
     */
    public function modifApropos(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine();
        $repoApropos = $em->getRepository(Apropos::class);
        $apropos = $repoApropos->find(1);

        $form = $this->createForm(ModifAproposType::class,$apropos);

        if ($request->isMethod('POST')) {            
            $form->handleRequest($request);            
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($apropos);
                $em->flush();
                $this->addFlash('notice','Page modifiée');
                return $this->redirectToRoute('apropos');        
            }          
        } 

        return $this->render('static/modifApropos.html.twig', [            
            'form'=>$form->createView()        
        ]);
    }

    
    /**
     * @Route("/ajoutApropos", name="ajoutApropos")
     */
    public function ajoutApropos(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $apropos = new apropos();
        $form = $this->createForm(AjoutAproposType::class,$apropos);
        
        if ($request->isMethod('POST')){            
            $form -> handleRequest ($request);            
            if($form->isValid()){              
                $em = $this->getDoctrine()->getManager();              
                $em->persist($apropos);              
                $em->flush();        
                $this->addFlash('notice','Page ajoutée'); 
            }
            return $this->redirectToRoute('apropos');
          }

        return $this->render('static/ajoutApropos.html.twig', [
            'form'=>$form->createView()
        ]);
    }
}
