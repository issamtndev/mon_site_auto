<?php

namespace App\HomeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ModeleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('marques')
        ;
        $builder->add('marques', 'entity', array(
'class' => 'HomeBundle:Marque',
'property' => 'nom',
'required'  => false,
'empty_value' => 'Choisir une marque',            
'multiple' => false)
);
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\HomeBundle\Entity\Modele'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_homebundle_modele';
    }
}
