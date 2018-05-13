<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\PersonalInfo;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Hillrange\CKEditor\Form\CKEditorType;
use App\Entity\AcquiredSkills;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class PersonalInfoForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('surname', TextType::class)
        ->add('name', TextType::class)
        ->add('birthdate', DateType::class, array(
            'widget' => 'single_text',
        ))
        ->add('birthplace', TextType::class)
        ->add('maritalstatus', TextType::class)
        ->add('citizenship', TextType::class)
        ->add('children', IntegerType::class)
        ->add('salary', TextType::class)
        ->add('mobilephone', TextType::class)
        ->add('smoker', IntegerType::class)
        ->add('drivinglicence', TextType::class)
        ->add('mail', TextType::class)
        ->add('address', CKEditorType::class, array(
            'config' => array(
                'uiColor' => '#ffffff',
                'filebrowserBrowseRoute' => 'elfinder',
                'filebrowserBrowseRouteParameters' => array(
                    'instance' => 'default',
                    'homeFolder' => '')
            )));        
        
        
        if ($options['stateless']){
            $builder->add('submit', SubmitType::class);
        }
        
        
            
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('data_class', PersonalInfo::class);
        $resolver->setDefault('csrf_protection', false);
        $resolver->setDefault('stateless', true);
    }
    
}

