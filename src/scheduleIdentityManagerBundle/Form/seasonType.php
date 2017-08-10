<?php

namespace scheduleIdentityManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use scheduleIdentityManagerBundle\Entity\league;

class seasonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
     public function buildForm(FormBuilderInterface $builder, array $options){
          $builder->add('league', 'choice', array(
                        'choices' => $options['leagues']))->
                    add('seasonType', 'choice', array(
                        'choices' => $options['seasonType']))->
                    add('seasonStartDate', DateType::class, array(
                        'format'=> 'd-M-y'))->
                    add('seasonEndDate', DateType::class, array(
                         'format'=> 'd-M-y'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'scheduleIdentityManagerBundle\Entity\season',
            'leagues' => array(),
            'seasonType' => array()
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'scheduleidentitymanagerbundle_season';
    }


}
