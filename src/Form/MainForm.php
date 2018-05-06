<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Main;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Hillrange\CKEditor\Form\CKEditorType;

class MainForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('label', TextType::class)
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
        $resolver->setDefault('data_class', Main::class);
        $resolver->setDefault('csrf_protection', false);
    }

}
