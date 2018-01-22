<?php

namespace App\Form;

use App\Entity\Folder;
use App\Entity\Item;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ItemType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('type', ChoiceType::class, array(
                    'choices' => array(
                        'Guardar en ...' => null,
                        'nota' => 0,
                        'lista tareas' => 1
                    ))
                )
                ->add('folder', EntityType::class, array(
                    'class' => Folder::class,                   
                    'choice_label' => 'name',
                    'choice_value' => 'id'
                ))
                ->add('title')
                ->add('body', TextareaType::class, array(
                    'attr' => array('id' => 'tinymce'),
                ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Item::class,
        ]);
    }

}
