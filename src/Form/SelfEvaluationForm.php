<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Hillrange\CKEditor\Form\CKEditorType;
use App\Entity\SelfEvaluation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\SelfEvaluationCategories;



class SelfEvaluationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('brandapplication', TextType::class)
        ->add('product', TextType::class)
        ->add('evaluation', TextType::class)
        ->add('categorieToAdd', EntityType::class, [
            'label' => 'FORM.SELFEVALUATION.CATEGORIETOADD',
            'class'        => SelfEvaluationCategories::class,
            'choice_label' => 'label',
            'mapped'       => false,
        ])
        ->add('submit', SubmitType::class);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', SelfEvaluation::class);
        $resolver->setDefault('csrf_protection', false);
    }
    
}
