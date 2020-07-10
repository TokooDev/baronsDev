<?php

namespace App\Form;

use App\Entity\Chambres;
use App\Entity\Etudiants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EtudiantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('datenaissance', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('tel')
            ->add('email')
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'BOURSIER LOGE' =>' BOURSIER LOGE',
                    'BOURSIER NON LOGE' => 'BOURSIER NON LOGE',
                    'NON BOURSIER' => 'NON BOURSIER',
                ],
                "placeholder"=>"Choisir le type d'étudiant"
                ])
            ->add('pension', ChoiceType::class, [
                'choices'  => [
                    '20000' => 20000,
                    '40000' => 40000,
                ],
                "placeholder"=>"Choisir la pension"
                ])
            ->add('adresse')
            ->add('chambre', EntityType::class,[
                "class" => Chambres::class,
                "choice_label"=>function($room){
                    if($room->getType = "INDIVIDUELLE"){
                        if(count($room->getEtudiants()) < 1){
                            return $room->getNumChamb();
                        }
                    }elseif($room->getType = "A DEUX"){
                        if(count($room->getEtudiants()) < 2){
                            return $room->getNumChamb();
                        }
                    }

                },
                "placeholder"=>"Choisir le numéro de la chambre"

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiants::class,
            'csrf_protection'=>false,
        ]);
    }
}
