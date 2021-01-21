<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Genre;
use App\Form\AjoutGenreType;
use Symfony\Component\HttpFoundation\Request;

class GenreController extends AbstractController
{
    /**
     * @Route("/ajoutGenre", name="ajoutGenre")
     */
    public function ajoutGenre(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $genre = new Genre();
        $form = $this->createForm(ajoutGenreType::class,$genre);
        
        if ($request->isMethod('POST')){            
            $form -> handleRequest ($request);            
            if($form->isValid()){              
              $em = $this->getDoctrine()->getManager();              
              $em->persist($genre);              
              $em->flush();        
            $this->addFlash('notice','Genre ajouté'); 
           
            } 
            return $this->redirectToRoute('ajoutGenre');
          }

        return $this->render('genre/ajout.html.twig', [
            'form'=>$form->createView()
        ]);
    }

    /**
    * @Route("/listeGenres", name="listeGenres")
    */
    public function listeGenres(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $em = $this->getDoctrine();
        $repoGenre = $em->getRepository(Genre::class);

        if($request->get('supp')!=null){
            $genre = $repoGenre->find($request->get('supp'));
            if($genre!=null){
                $em->getManager()->remove($genre);
                $em->getManager()->flush();
            }
            $this->redirectToRoute('listeGenres');
        }
    
        $genre = $repoGenre->findBy(array(), array('id'=>'ASC'));
            
        return $this->render('genre/liste.html.twig', [
            'genre'=>$genre
        ]);
    }
}
