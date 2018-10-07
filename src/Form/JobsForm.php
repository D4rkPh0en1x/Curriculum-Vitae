<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use App\Entity\Jobs;

class JobsForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('label', TextType::class)
        ->add('location', TextType::class)
        ->add('country', TextType::class)
        ->add('jobstart', DateType::class, array(
            'widget' => 'single_text',
        ))
        ->add('jobend', DateType::class, array(
            'widget' => 'single_text',
            'required' => false,
        ))
        ->add('employedas', TextType::class)
        ->add('description', CKEditorType::class, array(
            'config' => array(
                'uiColor' => '#ffffff',
                'filebrowserBrowseRoute' => 'elfinder',
                'filebrowserBrowseRouteParameters' => array(
                    'instance' => 'default',
                    'homeFolder' => '')
            )))
            ->add('submit', SubmitType::class);
            
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', Jobs::class);
        $resolver->setDefault('csrf_protection', false);
    }
    
}
