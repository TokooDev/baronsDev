<?php

namespace App\Controller;

use App\Entity\Chambres;
use App\Form\ChambresType;
use App\Repository\ChambresRepository;
use App\Repository\EtudiantsRepository;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\String\u;
use Symfony\Component\HttpFoundation\Request;
use MercurySeries\FlashyBundle\FlashyNotifier;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     */
    public function form(Chambres $chambre =null,FlashyNotifier $flashy, Request $request, EntityManagerInterface $manager){
        if(!$chambre){
            $chambre = new Chambres();
        }
        $form = $this->createForm(ChambresType::class, $chambre);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $rand = random_int(1, 10000);
            if($chambre->getNumBat() <= 9){
                $chambre->setNumChamb("000".$chambre->getNumBat()."-".$rand);
            }elseif($chambre->getNumBat() <= 99){
                $chambre->setNumChamb("00".$chambre->getNumBat()."-".$rand);
            }elseif($chambre->getNumBat() <= 999){
                $chambre->setNumChamb("0".$chambre->getNumBat()."-".$rand);
            }elseif($chambre->getNumBat() <= 9999){
                $chambre->setNumChamb($chambre->getNumBat()."-".$rand);
            }     
            $manager->persist($chambre);
            $manager->flush();
            $flashy->success('Opération effectuée avec succès!','chambres');
            return $this->redirectToRoute('chambres');
        }
        return $this->render('chambres/create.html.twig',[
            'formchambre' => $form->createView(),
            'editChambre'=> $chambre->getId() !== null
        ]);
    }

    /**
     * @Route("/chambres/{id<\d+>}/isRoomVide", name="is_room_vide", methods={"POST"})
     */
    public function isRoomVide(EtudiantsRepository $etudiantRepo,Chambres $chambre){

        $etudiant= $etudiantRepo->findOneBy([
            "chambre" =>$chambre
        ]);
        $statut = ['message'=>""];
        if($etudiant){
            $statut['message'] ="occupe";
        }else{
            $statut['message'] ="libre";
        }
        return new JsonResponse(json_encode($statut));
    }
    /**
     *@Route("/chambres/{id}/delete/", name="chambres_delete")
     */
    public function delete(Chambres $chambre,ChambresRepository $repo,FlashyNotifier $flashy, Request $request, EntityManagerInterface $manager){
        $repo->find($chambre->getId());
        $manager->remove($chambre);
        $manager->flush();
        $flashy->success('Chambre supprimée avec succès!','chambres');
        return $this->redirectToRoute('chambres');
    }

}
