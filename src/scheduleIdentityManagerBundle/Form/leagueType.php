<?php

namespace scheduleIdentityManagerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use scheduleIdentityManagerBundle\Entity\discipline;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class leagueType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('leagueName', 'text', array(
            'label' => 'nazwa liki'))
                ->add('discipline', 'choice', array(
                    'choices' => $options['disciplines'],
                ))
                ->add('leagueType', ChoiceType::class, array(
                    'choices' => array(
                        'spo' => 'season + play off',
                        'sea' => 'season',
                        'tou' => 'tournament',
                        'oth' => 'other' ),
                    'label' => 'rodzaj rozgrywek'))
                ->add('leagueStatus', ChoiceType::class, array(
                    'choices' => array(
                        'open'  => 'open',
                        'close' => 'close'),
                    'label' => 'status ligi'))
                ->add('ifTournament', ChoiceType::class, array(
                    'choices' => array(
                         true  => 'Tak',
                         false => 'Nie' ),
                    'label' => 'Czy turniej?'))
                ->add('ifPlayoffs', ChoiceType::class, array(
                    'choices' => array(
                         true => 'Tak',
                         false => 'Nie'),
                    'label' => 'Czy liga ma play-off?'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'scheduleIdentityManagerBundle\Entity\league',
            'disciplines' => array()
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'scheduleidentitymanagerbundle_league';
    }


}
