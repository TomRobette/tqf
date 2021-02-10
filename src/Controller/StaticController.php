<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Apropos;
use App\Entity\Chronique;
use App\Form\AjoutAproposType;
use App\Form\ModifAproposType;
use App\Form\AjoutChroniqueType;
use App\Form\ModifChroniqueType;
use App\Form\ContactType;
use App\Entity\Oeuvre;

class StaticController extends AbstractController
{
    /**
     * @Route("/pageAdmin", name="pageAdmin")
     */
    public function pageAdmin()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('static/pageAdmin.html.twig', [
        ]);
    }

    /**
     * @Route("/mentionslegales", name="mentionslegales")
     */
    public function mentionslegales()
    {
        return $this->render('static/mentionslegales.html.twig', [
        ]);
    }

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
     * @Route("/ajoutApropos", name="ajoutApropos")
     */
    public function ajoutApropos(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $apropos = new Apropos();
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
     * @Route("/chronique", name="chronique")
     */
    public function chronique(Request $request)
    {
        $em = $this->getDoctrine();
        $repoChronique = $em->getRepository(Chronique::class);
    
        $chroniques = $repoChronique->findBy(array(), array('date'=>'DESC'));
      
        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {  
            $jsonData = array();  
            $idx = 0;  
            foreach($chroniques as $chronique) {  
                $temp = ['id' => $chronique->getId(), 'texte' => $chronique->getTexte(), 'date' => $chronique->getDate()->format("d-m-Y")];   
                $jsonData[$idx++] = $temp;  
            }
            return $this->json($jsonData); 
        } else { 
            return $this->render('static/chronique.html.twig'); 
        } 
    }
    
    /**
     * @Route("/ajoutChronique", name="ajoutChronique")
     */
    public function ajoutChronique(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $chronique = new Chronique();
        $form = $this->createForm(AjoutChroniqueType::class,$chronique);
        
        if ($request->isMethod('POST')){            
            $form -> handleRequest ($request);            
            if($form->isValid()){              
                $em = $this->getDoctrine()->getManager();              
                $em->persist($chronique);              
                $em->flush();        
                $this->addFlash('notice','Page ajoutée'); 
            }
            return $this->redirectToRoute('chronique');
          }

        return $this->render('static/ajoutChronique.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/modifChronique/{id}", name="modifChronique", requirements={"id"="\d+"})
     */
    public function modifChronique(int $id, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine();
        $repoChronique = $em->getRepository(Chronique::class);
        $chronique = $repoChronique->find($id);

        $form = $this->createForm(ModifChroniqueType::class,$chronique);

        if ($request->isMethod('POST')) {            
            $form->handleRequest($request);            
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($chronique);
                $em->flush();
                $this->addFlash('notice','Page modifiée');
                return $this->redirectToRoute('chronique');        
            }          
        } 

        return $this->render('static/modifChronique.html.twig', [            
            'form'=>$form->createView()        
        ]);
    }

    /**
    * @Route("/listeChroniques", name="listeChroniques")
    */
    public function listeChroniques(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine();
        $repoChronique = $em->getRepository(Chronique::class);

        if($request->get('supp')!=null){
            $chronique = $repoChronique->find($request->get('supp'));
            if($chronique!=null){
                $em->getManager()->remove($chronique);
                $em->getManager()->flush();
            }
            $this->redirectToRoute('listeChroniques');
        }
    
        $chroniques = $repoChronique->findBy(array(), array('id'=>'ASC'));
            
        return $this->render('static/listeChroniques.html.twig', [
            'chroniques'=>$chroniques
        ]);
    }

    /**
    * @Route("/contact", name="contact")
    */
    public function contact(Request $request, \Swift_Mailer $mailer)
    {
    $form = $this->createForm(ContactType::class);
    if ($request->isMethod('POST')) {
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $message = (new \Swift_Message($form->get('subject')->getData()))
            ->setFrom($form->get('email')->getData())
            ->setTo('pepitttto@outlook.com')
            ->setBody($this->renderView('static/email.html.twig', array('name'=>$form->get('name')->getData(),'subject'=>$form->get('subject')->getData(),'message'=>$form->get('message')->getData())), 'text/html');
            $mailer->send($message);
            $this->addFlash('notice','Message envoyé');
            return $this->redirectToRoute('contact');
        }
    }
    return $this->render('static/contact.html.twig', [
    'form'=>$form->createView()
    ]);
 }
    /**
     * @Route("/parutions", name="parutions")
     */
    public function parutions(Request $request)
    {
        $em = $this->getDoctrine();
        $repoOeuvre = $em->getRepository(Oeuvre::class);

        
        $now = new \DateTime();
        $daysAgo = $now->sub(new \DateInterval('P2Y'));
        

        if($request->get('supp')!=null){
            $oeuvre = $repoOeuvre->find($request->get('supp'));
            if($oeuvre!=null){
                $em->getManager()->remove($oeuvre);
                $em->getManager()->flush();
            }
            $this->redirectToRoute('accueil');
        }
        $oeuvre = $repoOeuvre->createQueryBuilder('i')
        ->where('i.datePublication >= :date')
        ->setParameter('date', $daysAgo)
        ->orderBy('i.datePublication', 'DESC')
        ->getQuery()
        ->getResult();
            
        return $this->render('static/parutions.html.twig', [
            'oeuvres'=>$oeuvre
        ]);
    }

}
