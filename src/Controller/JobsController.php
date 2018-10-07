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
use App\Entity\Jobs;
use App\Form\JobsForm;
use FOS\CKEditorBundle\Form\Type\CKEditorType;


class JobsController extends Controller
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

    public function jobsMain(Environment $twig)
    {

        $repository = $this->getDoctrine()
        ->getRepository(Jobs::class);
        $jobs = $repository->findBy([], ['jobstart' => 'DESC']);

        return new Response(
            $twig->render(
                'Jobs/jobsMain.html.twig',
                [
                    'jobs' => $jobs

                ]
                )
            );
    }




    public function jobsAdd(Environment $twig, Request $request, UrlGeneratorInterface $urlGenerator)
    {
        $main = new Jobs();

        $form = $this->formFactory->create(JobsForm::class, $main);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


            $this->manager->persist($main);
            $this->manager->flush();

            return new RedirectResponse($urlGenerator->generate('jobs_main'));

        }



        return new Response(
            $this->twig->render('Jobs/jobAdd.html.twig',
                ['form' => $form->createView()]));
    }

    
    
    /**
     * @param Request  $request
     * @param Jobs $jobid
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/jobs/edit/{jobid}", name="jobedit")
     */
    public function jobsEdit(Request $request, Jobs $jobid, FormFactoryInterface $factory, ObjectManager $manager,  UrlGeneratorInterface $urlGenerator )
    {
        
        $editJobId = $jobid->getID();
        
        $this->get('form.factory')->createNamed($editJobId);
        
        
        
        $builder = $factory->createBuilder(FormType::class, $jobid);
        $builder->add(
            'label',
            TextType::class,
            [
                'required' => true,
                'attr' => [
                    'placeholder' => 'FORM.JOBS.PLACEHOLDER.LABEL',
                    'class' => 'modifylabel'
                    
                ]
            ]
            )
            
            
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
            
                       
            ->add('save', SubmitType::class, array('label' => 'Modify the job'));
            
            $formeditjob = $builder->getForm();
            $formeditjob->handleRequest($request);
            
            
            
            
            if ($formeditjob->isSubmitted() && $formeditjob->isValid()) {
                

                
                $manager->persist($jobid);
                $manager->flush();
                return new RedirectResponse($urlGenerator->generate('jobs_main'));
            }
            
            return $this->render('Jobs/jobEdit.html.twig', [
                'jobedit' => $formeditjob->createView(),
                'routeAttr' => ['jobid' => $jobid ->getId()
                ],
                'currentjob' => $jobid ->getId()
            ]);
    }
    
    
    
    
    

}
