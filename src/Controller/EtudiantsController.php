<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EtudiantsRepository;
class EtudiantsController extends AbstractController
{
    /**
     * @Route("/etudiants", name="etudiants")
     */
    public function index(EtudiantsRepository $repo)
    {
        $etudiants = $repo->findAll();
        return $this->render('etudiants/index.html.twig', [
            'controller_name' => 'EtudiantsController',
            'etudiants' => $etudiants
        ]);
    }
}
