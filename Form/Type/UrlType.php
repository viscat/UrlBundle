<?php

namespace Kolekti\UrlBundle\Form\Type;
 
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\FormInterface;

use Kolekti\UrlBundle\Entity\Url;
 
class UrlType extends AbstractType
{
    
    public function __construct() {}
    
    /**
     * Creates the form view
     * 
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {      
        $builder                
                ->add('url', 'url', array('label'=> 'Url To Download'));
    }
 
    /**
     * Returns the form name
     * 
     * @return string
     */
    public function getName()
    {
        return 'Url';
    }
    
    /**
     * Sets the default form options
     * 
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver     
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kolekti\UrlBundle\Entity\Url',     
            'empty_data' => function (FormInterface $form) {
                                return new Url($form->get('url')->getData());
                            },
        ));
    }
}

?>
