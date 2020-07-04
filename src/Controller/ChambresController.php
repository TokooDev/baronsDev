<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ChambresRepository;
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
}
