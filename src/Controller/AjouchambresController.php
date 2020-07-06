<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etudiants;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ChambresRepository;
use App\Form\ChambresType;
use function Symfony\Component\String\u;

class AjouchambresController extends AbstractController
{
    /**
     * @Route("/ajouchambres", name="ajouchambres")
     */
    public function index()
    {
        return $this->render('ajouchambres/index.html.twig', [
            'controller_name' => 'AjouchambresController',
        ]);
    }

    public function create()
    {
        $chambres= new chambres();
        $form=$this->createForm(ChambresType::class,$chambres);
        dump($form);
            return $this->render('ajouchambres/index.html.twig', [
                
                'form' => $form->createView()
            ]);
    }

    
}
