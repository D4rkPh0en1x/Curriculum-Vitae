<?php
namespace App\Controller;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Doctrine\DBAL\Types\ArrayType;
use App\Repository\RoleRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use App\Entity\PersonalInfo;
use App\Form\PersonalInfoForm;
use App\Entity\AcquiredSkills;
use App\Manager\AcquireSkillsManager;
use App\Repository\PersonalInfoRepository;
use App\Form\PersonalInfoFormEdit;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Hillrange\CKEditor\Form\CKEditorType;
use App\Entity\Languages;
use App\Entity\Hobbies;
use App\Entity\Web;
use App\Entity\SoftSkills;


class PersonalInfoController extends Controller
{
    
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;
    
    /**
     * @var EntityManagerInterface
     */
    private $manager;
    
    /**
     * @var Environment
     */
    private $twig;
    
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;
    
    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $manager, Environment $twig, UrlGeneratorInterface $urlGenerator)
    {
        $this->formFactory = $formFactory;
        $this->manager = $manager;
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }
    
    public function personalInfoMain(Environment $twig)
    {
        
        $repository = $this->getDoctrine()
        ->getRepository(PersonalInfo::class);
        $personalinfo = $repository->findAll();
        
        return new Response(
            $twig->render(
                'PersonalInfo/personalInfoMain.html.twig',
                [
                    'personalinfo' => $personalinfo
                    
                ]
                )
            );
    }
    
    
    
 
    
    /**
     * @param Request  $request
     * @param PersonalInfo $personalinfoid
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/personalinfo/acquiredskill/add/{personalinfoid}", name="acquiredskill_add")
     */
    public function personalInfoAddAcquiredSkill(
        Request $request, 
        PersonalInfo $personalinfoid,
        PersonalInfoRepository $repository,
        FormFactoryInterface $factory, 
        ObjectManager $manager,
        UrlGeneratorInterface $urlGenerator
        ) {
            $editPersonalInfoId = $personalinfoid->getID();
            
            $personalInfo = $repository->find($editPersonalInfoId);
            
            $acquiredskill = new AcquiredSkills();
            
            $builder = $factory->createBuilder(FormType::class, $acquiredskill);
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
            

            $form = $builder->getForm();
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
               $acquiredskill->setPersonalinfo($personalInfo);
               $manager->persist($acquiredskill);
               $manager->flush();
               return new RedirectResponse($urlGenerator->generate('personalinfo_main'));
            }
            
            return $this->render(
                    'PersonalInfo/personalInfoEdit.html.twig',
                    [
                        'form' => $form->createView(),
                        'routeAttr' => ['personalinfoid' => $personalinfoid->getId()],
                        'currentpersonalinfo' => $personalinfoid ->getId(),
                    ]
                    
                );
    }
    
  

    
    
    
    public function personalInfoAdd(Environment $twig, Request $request, UrlGeneratorInterface $urlGenerator)
    {
        $main = new PersonalInfo();
        
        $form = $this->formFactory->create(PersonalInfoForm::class, $main);
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            
            $this->manager->persist($main);
            $this->manager->flush();
            
            return new RedirectResponse($urlGenerator->generate('personalinfo_main'));
            
        }
        
        
        
        return new Response(
            $this->twig->render('PersonalInfo/personalInfoAdd.html.twig',
                ['form' => $form->createView()]));
    } 
    
    
    
    
    /**
     * @param Request  $request
     * @param PersonalInfo $personalinfoid
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/personalinfo/languages/add/{personalinfoid}", name="languages_add")
     */
    public function personalInfoAddLanguages(
        Request $request,
        PersonalInfo $personalinfoid,
        PersonalInfoRepository $repository,
        FormFactoryInterface $factory,
        ObjectManager $manager,
        UrlGeneratorInterface $urlGenerator
        ) {
            $editPersonalInfoId = $personalinfoid->getID();
            
            $personalInfo = $repository->find($editPersonalInfoId);
            
            $languages = new Languages();
            
            $builder = $factory->createBuilder(FormType::class, $languages);
            $builder->add('label', TextType::class)
                    ->add('written', TextType::class)
                    ->add('spoken', TextType::class)
                
                ->add('submit', SubmitType::class);
                
                
                $form = $builder->getForm();
                $form->handleRequest($request);
                
                if ($form->isSubmitted() && $form->isValid()) {
                    $languages->setPersonalinfo($personalInfo);
                    $manager->persist($languages);
                    $manager->flush();
                    return new RedirectResponse($urlGenerator->generate('personalinfo_main'));
                }
                
                return $this->render(
                    'PersonalInfo/personalInfoAddLanguages.html.twig',
                    [
                        'form' => $form->createView(),
                        'routeAttr' => ['personalinfoid' => $personalinfoid->getId()],
                        'currentpersonalinfo' => $personalinfoid ->getId(),
                    ]
                    
                    );
    }
 
    
    
    /**
     * @param Request  $request
     * @param PersonalInfo $personalinfoid
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/personalinfo/hobbies/add/{personalinfoid}", name="hobbies_add")
     */
    public function personalInfoAddHobbies(
        Request $request,
        PersonalInfo $personalinfoid,
        PersonalInfoRepository $repository,
        FormFactoryInterface $factory,
        ObjectManager $manager,
        UrlGeneratorInterface $urlGenerator
        ) {
            $editPersonalInfoId = $personalinfoid->getID();
            
            $personalInfo = $repository->find($editPersonalInfoId);
            
            $hobbies = new Hobbies();
            
            $builder = $factory->createBuilder(FormType::class, $hobbies);
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
            
            
            $form = $builder->getForm();
            $form->handleRequest($request);
            
            if ($form->isSubmitted() && $form->isValid()) {
                $hobbies->setPersonalinfo($personalInfo);
                $manager->persist($hobbies);
                $manager->flush();
                return new RedirectResponse($urlGenerator->generate('personalinfo_main'));
            }
            
            return $this->render(
                'PersonalInfo/personalInfoAddHobbies.html.twig',
                [
                    'form' => $form->createView(),
                    'routeAttr' => ['personalinfoid' => $personalinfoid->getId()],
                    'currentpersonalinfo' => $personalinfoid ->getId(),
                ]
                
                );
    }
    
    

    /**
     * @param Request  $request
     * @param PersonalInfo $personalinfoid
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/personalinfo/webs/add/{personalinfoid}", name="webs_add")
     */
    public function personalInfoAddWebs(
        Request $request,
        PersonalInfo $personalinfoid,
        PersonalInfoRepository $repository,
        FormFactoryInterface $factory,
        ObjectManager $manager,
        UrlGeneratorInterface $urlGenerator
        ) {
            $editPersonalInfoId = $personalinfoid->getID();
            
            $personalInfo = $repository->find($editPersonalInfoId);
            
            $webs = new Web();
            
            $builder = $factory->createBuilder(FormType::class, $webs);
            $builder->add('label', TextType::class)
            ->add('url', CKEditorType::class, array(
                'config' => array(
                    'uiColor' => '#ffffff',
                    'filebrowserBrowseRoute' => 'elfinder',
                    'filebrowserBrowseRouteParameters' => array(
                        'instance' => 'default',
                        'homeFolder' => '')
                )))
                
                ->add('submit', SubmitType::class);
                
                
                $form = $builder->getForm();
                $form->handleRequest($request);
                
                if ($form->isSubmitted() && $form->isValid()) {
                    $webs->setPersonalinfo($personalInfo);
                    $manager->persist($webs);
                    $manager->flush();
                    return new RedirectResponse($urlGenerator->generate('personalinfo_main'));
                }
                
                return $this->render(
                    'PersonalInfo/personalInfoAddHobbies.html.twig',
                    [
                        'form' => $form->createView(),
                        'routeAttr' => ['personalinfoid' => $personalinfoid->getId()],
                        'currentpersonalinfo' => $personalinfoid ->getId(),
                    ]
                    
                    );
    }
    
    
    /**
     * @param Request  $request
     * @param PersonalInfo $personalinfoid
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/personalinfo/softskills/add/{personalinfoid}", name="softskills_add")
     */
    public function personalInfoAddSoftSkills(
        Request $request,
        PersonalInfo $personalinfoid,
        PersonalInfoRepository $repository,
        FormFactoryInterface $factory,
        ObjectManager $manager,
        UrlGeneratorInterface $urlGenerator
        ) {
            $editPersonalInfoId = $personalinfoid->getID();
            
            $personalInfo = $repository->find($editPersonalInfoId);
            
            $softskills = new SoftSkills();
            
            $builder = $factory->createBuilder(FormType::class, $softskills);
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
                
                
                $form = $builder->getForm();
                $form->handleRequest($request);
                
                if ($form->isSubmitted() && $form->isValid()) {
                    $softskills->setPersonalinfo($personalInfo);
                    $manager->persist($softskills);
                    $manager->flush();
                    return new RedirectResponse($urlGenerator->generate('personalinfo_main'));
                }
                
                return $this->render(
                    'PersonalInfo/personalInfoAddSoftSkills.html.twig',
                    [
                        'form' => $form->createView(),
                        'routeAttr' => ['personalinfoid' => $personalinfoid->getId()],
                        'currentpersonalinfo' => $personalinfoid ->getId(),
                    ]
                    
                    );
    }
    
    
    
    
    
    
    
    
}

