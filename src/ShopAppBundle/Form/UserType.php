<?php

namespace ShopAppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', 'text', ['label' => 'Login:'])
            ->add('name', 'text', ['label' => 'Imię:'])
            ->add('surname', 'text', ['label' => 'Nazwisko:'])
            ->add('email', 'email', ['label' => 'Adres E-mail:'])
            ->add('plainPassword', 'password', ['label' => 'Hasło:'])
            ->add('address', 'text', ['label' => 'Pełny adres:'])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShopAppBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'shopappbundle_user';
    }
}
