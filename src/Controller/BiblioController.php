<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use App\Entity\Fichier;
use App\Entity\Biblio;
use App\Form\AjoutBiblioType;
use App\Form\ModifBiblioType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class BiblioController extends AbstractController
{
    /**
     * @Route("/ajoutBiblio", name="ajoutBiblio")
     */
    public function ajoutBiblio(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $biblio = new Biblio();
        $form = $this->createForm(AjoutBiblioType::class,$biblio);
        if ($request->isMethod('POST')){           
            $form->handleRequest($request);            
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                if($biblio->getImage()!=null){
                    $fichier = new Fichier();
                    $fichier->setNom($biblio->getImage());
                    $file = $fichier->getNom();
                    $fichier->setExtension($file->guessExtension()); //On récupère l'extension
                    $fichier->setTaille($file->getSize());
                    $fichier->setVraiNom($file->getClientOriginalName());
                    $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                    $fichier->setNom($fileName);
                    $em->persist($fichier);
                    $biblio->setImage($fichier);
                }
                $em->persist($biblio);
                $em->flush();
                try{
                    $file->move($this->getParameter('biblio_directory'),$fileName);
                }catch(FileException $e){
                    $this->addFlash('notice','Aucune image insérée');
                }

                $this->addFlash('notice','Tirage ajouté');
                return $this->redirectToRoute('bibliophilie');        
            }   
          }
        return $this->render('biblio/ajout.html.twig', [
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
    * @Route("/bibliophilie", name="bibliophilie")
    */
    public function bibliophilie(Request $request)
    {
        $em = $this->getDoctrine();
        $repoBiblio = $em->getRepository(Biblio::class);

        if($request->get('supp')!=null){
            $biblio = $repoBiblio->find($request->get('supp'));
            if($biblio!=null){
                $em->getManager()->remove($biblio);
                $em->getManager()->flush();
            }
            $this->redirectToRoute('bibliophilie');
        }
    
        $images = array();
        $biblio = $repoBiblio->findBy(array(), array());
        foreach($biblio as $i){
            if($i->getImage()==null){
                $path = $this->getParameter('biblio_directory').'/default.png';
            }else{
                $path = $this->getParameter('biblio_directory').'/'.$i->getImage()->getNom();
            }
            $data = file_get_contents($path);
            $base64 = 'data:image/png;base64,'.base64_encode($data);
            array_push($images,$base64);
        }
            
        return $this->render('biblio/bibliophilie.html.twig', [
            'biblios'=>$biblio,
            'images'=>$images
        ]);
    }

    /**
     * @Route("/modifBiblio/{id}", name="modifBiblio", requirements={"id"="\d+"})
     */
    public function modifBiblio(int $id, Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine();
        $repoBiblio = $em->getRepository(Biblio::class);
        $biblio = $repoBiblio->find($id);

        if($biblio==null){
            $this->addFlash('notice','Cette page n\'existe pas');
            return $this->redirectToRoute('biblio');   
        }

        $form = $this->createForm(ModifBiblioType::class,$biblio);

        if ($request->isMethod('POST')) {            
            $form->handleRequest($request);            
            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                if($biblio->getImage()!=null){
                    $fichier = new Fichier();
                    $fichier->setNom($biblio->getImage());
                    $file = $fichier->getNom();
                    $fichier->setExtension($file->guessExtension()); //On récupère l'extension
                    $fichier->setTaille($file->getSize());
                    $fichier->setVraiNom($file->getClientOriginalName());
                    $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();
                    $fichier->setNom($fileName);
                    $em->persist($fichier);
                    $biblio->setImage($fichier);
                }
                $em->persist($biblio);
                $em->flush();
                try{
                    $file->move($this->getParameter('biblio_directory'),$fileName);

                }catch(FileException $e){
                    $this->addFlash('notice','Aucune image insérée');
                }
                $this->addFlash('notice','Tirage modifié');
                return $this->redirectToRoute('listeBiblios');        
            }          
        } 

        return $this->render('biblio/modif.html.twig', [            
            'form'=>$form->createView()        
        ]);
    }
}
