<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Chambres;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ChambresRepository;
use App\Form\ChambresType;
use function Symfony\Component\String\u;
class ChambresController extends AbstractController
{
    /**
     * @Route("/chambres", name="chambres")
     */
    public function index(ChambresRepository $repo)
    {
        $chambres = $repo->findAll();
        return $this->render('chambres/index.html.twig', [
            'controller_name' => 'ChambresController',
            'chambres' => $chambres
        ]);
    }

        /**
     * @Route("/chambres/new", name="chambres_create")
     * @Route("/chambres/{id}/edit", name="chambres_edit")
     * * @Route("/chambres/{id}/delete", name="chambres_delete")
     */
    public function form(Chambres $chambre =null, Request $request, EntityManagerInterface $manager)
    {
        if(!$chambre){
            $chambre = new Chambres();
        }
        $form = $this->createForm(ChambresType::class, $chambre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if(!$chambre->getId()){
                
            }
            $manager= $this->getDoctrine()->getManager();          
            $manager->persist($chambre);
            $manager->flush();
            return $this->redirectToRoute('chambres',);
        }
        return $this->render('chambres/create.html.twig',[
            'formchambre'=> $form->createView(),
            'editMode'=> $chambre->getId() !== null
        ]);
    }


        /**
     * * @Route("/chambres/{id}/delete", name="chambres_delete")
     */

public function delete(EntityManagerInterface $em,Chambres $chambre)
{
    $em=remove($chambre);
    $em=flush();
    return $this->readirectToRoute('chambres');
}
}

