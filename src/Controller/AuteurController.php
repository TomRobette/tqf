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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
            $form->handleRequest($request);            
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $fichier = new Fichier();
                $fichier->setNom($auteur->getImage());
                $file = $fichier->getNom();
                $fichier->setExtension($file->guessExtension()); //On récupère l'extension
                $fichier->setTaille($file->getSize());
                $fichier->setVraiNom($file->getClientOriginalName());
                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                $fichier->setNom($fileName);
                $em->persist($fichier);
                $auteur->setImage($fichier);
                $em->persist($auteur);
                $em->flush();
                try{
                    $file->move($this->getParameter('auteur_directory'),$fileName);

                }catch(FileException $e){
                    $this->addFlash('notice','Erreur lors de l\'insertion de l\'image');
                }

                $this->addFlash('notice','Auteur ajouté');
                return $this->redirectToRoute('accueil');        
            }   
          }
        return $this->render('auteur/ajout.html.twig', [
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
    
        $auteur = $repoAuteur->findBy(array(), array('nom'=>'ASC'));
        $images = array();
        foreach($auteur as $i){
            if($i->getImage()==null){
                $path = $this->getParameter('auteur_directory').'/default.png';
            }else{
                $path = $this->getParameter('auteur_directory').'/'.$i->getImage()->getNom();
            }
            $data = file_get_contents($path);
            $base64 = 'data:image/png;base64,'.base64_encode($data);
            array_push($images,$base64);
        }
            
        return $this->render('auteur/liste.html.twig', [
            'auteur'=>$auteur,
            'images'=>$images
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

        if($auteur->getImage()==null){
            $path = $this->getParameter('auteur_directory').'/default.png';
        }else{
            $path = $this->getParameter('auteur_directory').'/'.$auteur->getImage()->getNom();
        }
        $data = file_get_contents($path);
        $base64 = 'data:image/png;base64,'.base64_encode($data);

        return $this->render('auteur/page.html.twig', [               
            'auteur'=>$auteur,
            'base64'=>$base64
        ]);
    }
}
