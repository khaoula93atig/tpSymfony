<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\Personne;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('age')
            ->add('firstname')
            ->add('image', FileType::class, [
                'mapped' => false, 'required'=>false,
                'constraints'=>[
                    new Image()
                ]
            ])
            ->add('createdAt')
            ->add('updatedAt')
            ->add('job',EntityType::class,['class'=>Job::class,
                'query_builder'=>function (EntityRepository $er)
                {
                    return $er ->createQueryBuilder('j')
                        ->orderBy('j.designation','ASC');
                },
                'choice_label'=>'designation'])
            ->add('hobbies')
            ->add('pieceIdentite')
            ->add('Ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}
