<?php

namespace App\HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use App\HomeBundle\Form\ImageType;


class AutoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       $builder->add('titre', 'text');
        $builder->add('prix', 'text');
$builder->add('image', new ImageType());
        
        $builder->add('marque', 'entity', array(
'class' => 'HomeBundle:Marque',
'choice_label' => 'nom',
'required'  => false,
'empty_value' => 'Choisir une marque',            
'multiple' => false)
);
        $builder->add('modele', 'entity', array(
'class' => 'HomeBundle:Modele',
'choice_label' => 'nom',
'required'  => false,            
'multiple' => false)
);
             $builder->add('nbporte' ,'choice' ,array('choices' => array(
        "1" => "1",
        "2" => "2",
        ),
        'required'  => false,
        'empty_value' => 'Choisir le nombre des portes',
        'multiple' => false,
));
             $builder->add('description', 'textarea',array('attr'=>array('class' => 'ckeditor')));
        $builder->add('save', 'submit');
    }
    
   

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_homebundle_auto';
    }
}
