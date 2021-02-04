<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use App\Entity\Fichier;
use App\Entity\Oeuvre;
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
                $fichier = new Fichier();
                $fichier->setNom($oeuvre->getCouverture());
                $file = $fichier->getNom();
                $fichier->setExtension($file->guessExtension()); //On récupère l'extension
                $fichier->setTaille($file->getSize());
                $fichier->setVraiNom($file->getClientOriginalName());
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                $fichier->setNom($fileName);
                $em->persist($fichier);
                $oeuvre->setCouverture($fichier);
                $em->persist($oeuvre);
                $em->flush();
                try{
                    $file->move($this->getParameter('couv_directory'),$fileName);

                }catch(FileException $e){
                    $this->addFlash('notice','Erreur lors de l\'insertion de l\'image');
                }

                $this->addFlash('notice','Oeuvre ajouté');
                return $this->redirectToRoute('accueil');        
            }   
          }
        return $this->render('oeuvre/ajout.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**     
     * @return string     
     */    
    
    private function generateUniqueFileName()    
    {        
        return md5(uniqid());    
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
    
        $images = array();
        foreach($oeuvre as $i){
            if($i->getCouverture()==null){
                $path = $this->getParameter('couv_directory').'/default.png';
            }else{
                $path = $this->getParameter('couv_directory').'/'.$i->getCouverture()->getNom();
            }
            $data = file_get_contents($path);
            $base64 = 'data:image/png;base64,'.base64_encode($data);
            array_push($images,$base64);
        }
            
        return $this->render('oeuvre/liste.html.twig', [
            'oeuvre'=>$oeuvre,
            'images'=>$images,
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

        if($oeuvre->getCouverture()==null){
            $path = $this->getParameter('couv_directory').'/default.png';
        }else{
            $path = $this->getParameter('couv_directory').'/'.$oeuvre->getCouverture()->getNom();
        }
        $data = file_get_contents($path);
        $base64 = 'data:image/png;base64,'.base64_encode($data);

        return $this->render('oeuvre/page.html.twig', [               
            'oeuvre'=>$oeuvre,
            'base64'=>$base64
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
                $fichier = new Fichier();
                $fichier->setNom($oeuvre->getCouverture());
                $file = $fichier->getNom();
                $fichier->setExtension($file->guessExtension()); //On récupère l'extension
                $fichier->setTaille($file->getSize());
                $fichier->setVraiNom($file->getClientOriginalName());
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                $fichier->setNom($fileName);
                $em->persist($fichier);
                $oeuvre->setCouverture($fichier);
                $em->persist($oeuvre);
                $em->flush();
                try{
                    $file->move($this->getParameter('couv_directory'),$fileName);

                }catch(FileException $e){
                    $this->addFlash('notice','Erreur lors de l\'insertion de l\'image');
                }
                $this->addFlash('notice','Oeuvre modifiée');
                return $this->redirectToRoute('listeOeuvres');        
            }          
        } 

        return $this->render('oeuvre/modif.html.twig', [            
            'form'=>$form->createView()        
        ]);
    }
}
