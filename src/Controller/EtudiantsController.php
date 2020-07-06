<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etudiants;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EtudiantsRepository;
use App\Form\EtudiantsType;
use MercurySeries\FlashyBundle\FlashyNotifier;
use function Symfony\Component\String\u;
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

    /**
     * @Route("/etudiants/new", name="etudiants_create")
     * @Route("/etudiants/{id}/edit", name="etudiants_edit")
     */
    public function form(Etudiants $etudiant =null,FlashyNotifier $flashy, Request $request, EntityManagerInterface $manager){
        if(!$etudiant){
            $etudiant = new Etudiants();
        }
        $form = $this->createForm(EtudiantsType::class, $etudiant);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $year = date("Y");
            $ll = u($etudiant->getPrenom())->slice(-2);
            $cc = u($etudiant->getNom())->slice(0,2);
            $rand = random_int(1, 10000);
            $etudiant->setMatricule($year.$cc.$ll.$rand);          
            $manager->persist($etudiant);
            $manager->flush();
            $flashy->success('Opération effectuée avec succès!','etudiants');
            return $this->redirectToRoute('etudiants');
        }
        return $this->render('etudiants/create.html.twig',[
            'formetudiant' => $form->createView(),
            'editMode'=> $etudiant->getId() !== null
        ]);
    }
}
