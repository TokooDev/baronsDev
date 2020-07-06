<?php

namespace App\Form;

use App\Entity\Chambres;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class ChambresType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numBat')
            ->add('type', ChoiceType::class, [
                'choices'  => [
                    'Séléctionner le type de chambre' =>'',
                    'CHAMBRE A DEUX' =>' A DEUX',
                    'CHAMBRE INDIVIDUELLE' => 'INDIVIDUELLE',
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chambres::class,
        ]);
    }
}
