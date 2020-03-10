<?php

namespace App\Form;

use App\Entity\Evaluation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', nul, ['label' => 'Commentaire'])
            ->add('grade', null, ['label' => 'Note', "attr" => [
                "min" => "0",
                "max" => "10"
              ]])
            ->add('Enregistrer', SubmitType::class, ['atr'=>[
                "class" => "secondBg d-block mx-auto",
              ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
