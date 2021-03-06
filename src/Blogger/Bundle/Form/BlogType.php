<?php

namespace Blogger\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                
           ->add('name', TextType::class)           
           ->add('sex', NumberType::class)
           ->add('submit', SubmitType::class)           
           ->add('reset', ResetType::class)
                
        ;
    }
    
}



