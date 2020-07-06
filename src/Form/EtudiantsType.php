<?php

namespace App\Form;

use App\Entity\Etudiants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
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
                    "Sélétionner le type d'étudiant" =>"",
                    'BOURSIER LOGE' =>' BOURSIER LOGE',
                    'BOURSIER NON LOGE' => 'BOURSIER NON LOGE',
                    'NON BOURSIER' => 'NON BOURSIER',
                ]])
            ->add('adresse')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudiants::class,
        ]);
    }
}
