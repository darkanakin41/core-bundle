<?php

namespace Darkanakin41\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeleteForm extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('delete', SubmitType::class, array(
            "label" => "action.delete.confirm",
            'attr' => array(
                'class' => "button success",
            ),
        ));
        $builder->add('cancel', SubmitType::class, array(
            'label' => "action.delete.cancel",
            'attr' => array(
                'class' => "button",
            ),
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection' => FALSE,
        ));
    }

    public function getName()
    {
        return 'delete_form';
    }

}
