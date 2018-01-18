<?php

namespace App\Form;

use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class NoteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('title', null, array(
                    'required' => false,
                ))
                ->add('tag', EntityType::class, array(
                    'class' => Tag::class,
                    'choice_label' => '',
                    'choice_name' => 'name',
                    'choice_value' => 'id'
                ))
                ->add('content', TextareaType::class, array(
                    'attr' => array('id' => 'tinymce'),
                ))
        ;
    }

}
