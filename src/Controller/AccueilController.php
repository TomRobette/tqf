<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\InscriptionType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccueilController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    /**
    * @Route("/inscrire", name="inscrire")
    */
    public function inscrire(Request $request, UserPasswordEncoderInterface $passwordEncoder){
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);
   
        if ($request->isMethod('POST')){
            $form -> handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $mdpConf = $form->get('confirmation')->getData();
                $mdp = $user->getPassword();
                if($mdp==$mdpConf){
                    $user->setRoles(array('ROLE_USER'));
                    $user->setPassword($passwordEncoder->encodePassword($user, $user->getPassword()));
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();
                    $this->addFlash('notice','Inscription réussie');
                    return $this->redirectToRoute('app_login');
                    
                }else{
                    $this->addFlash('notice','Erreur de mot de passe');
                    return $this->redirectToRoute('inscrire');

                }
            }
        }
   
    return $this->render('security/inscription.html.twig', ['form' => $form->createView()]);
    }
   
}
