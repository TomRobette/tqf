<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AjoutAmisTQFType;
use App\Entity\AmisTQF;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AmisTQFController extends AbstractController
{
    /**
     * @Route("/amistqf", name="amistqf")
     */
    public function amistqf(Request $request)
    {
        $amis = new AmisTQF();
        $form = $this->createForm(AjoutAmisTQFType::class,$amis);
        if ($request->isMethod('POST')){           
            $form->handleRequest($request);            
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($amis);
                $em->flush();
                $this->addFlash('notice','Demande ajoutée');
                return $this->redirectToRoute('accueil');        
            }   
          }
        return $this->render('amis/ajout.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
    * @Route("/listeAmisTQF", name="listeAmisTQF")
    */
    public function listeAmisTQF(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine();
        $repoAmis = $em->getRepository(AmisTQF::class);

        if($request->get('supp')!=null){
            $amis = $repoAmis->find($request->get('supp'));
            if($amis!=null){
                $em->getManager()->remove($amis);
                $em->getManager()->flush();
            }
            $this->redirectToRoute('listeAmisTQF');
        }
    
        $amis = $repoAmis->findBy(array(), array('dateAjout'=>'ASC'));
            
        return $this->render('amis/liste.html.twig', [
            'amis'=>$amis
        ]);
    }
}
