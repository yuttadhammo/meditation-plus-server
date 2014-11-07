<?php

namespace Sirimangalo\MeditationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommitmentType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description', 'textarea')
            ->add('period', 'choice', array(
                'empty_value' => 'Choose',
                'choices' => array(
                    'daily' => 'daily',
                    'weekly' => 'weekly',
                    'monthly' => 'monthly'
                )
            ))
            ->add('day')
            ->add('time')
            ->add('length')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sirimangalo\MeditationBundle\Entity\Commitment'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sirimangalo_meditationbundle_commitment';
    }
}
