<?php
/**
 * Created by PhpStorm.
 * User: alen
 * Date: 24.8.2019.
 * Time: 18:48
 */

namespace App\Form;

use App\DTO\BattleParameterDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BattleParameterType extends AbstractType
{
    /**
     *  Build form
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('army1', IntegerType::class, [
                'required' => false
            ])
            ->add('army2', IntegerType::class, [
                'required' => false
            ])
            ->add('supplies1', IntegerType::class, [
                'required' => false,
                'label' => 'Army 1 supplies (Optional)'
            ])
            ->add('supplies2', IntegerType::class, [
                'required' => false,
                'label' => 'Army 2 supplies (Optional)'
            ])
            ->add('advanced_tanks1', IntegerType::class, [
                'required' => false,
                'label' => 'Army 1 tank advancement percentage (Optional)'
            ])
            ->add('advanced_tanks2', IntegerType::class, [
                'required' => false,
                'label' => 'Army 2 tank advancement percentage (Optional)'
            ])
            ->add('name1', TextType::class, [
                'required' => false,
                'label' => 'Army 1 name (Optional)'
            ])
            ->add('name2', TextType::class, [
                'required' => false,
                'label' => 'Army 2 name (Optional)'
            ])
            ->add('field_size', IntegerType::class, [
                'required' => false,
                'label' => 'Field size'
            ])
            ->setMethod('GET');
    }

    /**
     *  Set this to empty string because we're not using prefix
     *
     * @return string
     */
    public function getBlockPrefix()
    {
        return "";
    }

    /**
     *  Set data class
     *
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => BattleParameterDTO::class
        ]);
    }
}