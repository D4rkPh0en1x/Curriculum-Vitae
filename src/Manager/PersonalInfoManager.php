<?php
namespace App\Manager;

use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\PersonalInfo;
use App\Form\AcquiredSkillsForm;
use App\Entity\AcquiredSkills;

class PersonalInfoManager
{
    private $formFactory;
    
    private $manager;
    
    public function getBaseForm($acquiredskill)
    {
        var_dump($acquiredskill);
        $formtest = $this->formFactory->create(AcquiredSkillsForm::class, $acquiredskill);
        var_dump($formtest);
        /*return $this->formFactory->create(
            AcquiredSkillsForm::class,
            $acquiredskill,
            ['stateless' => true]
            );*/
    }


public function handleRequest(FormInterface $form, Request $request)
{
    $form->handleRequest($request);
}




}