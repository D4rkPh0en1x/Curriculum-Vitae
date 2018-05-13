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
use App\Entity\SelfEvaluation;
use App\Form\SelfEvaluationForm;
use App\Entity\SelfEvaluationCategories;
use App\Form\SelfEvaluationCategoriesForm;


class SelfEvaluationController extends Controller
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
    
    public function selfEvaluationMain(Environment $twig)
    {
        
        $repository = $this->getDoctrine()
        ->getRepository(SelfEvaluation::class);
        $selfevaluation = $repository->findBy([], ['brandapplication' => 'ASC']);
        
        return new Response(
            $twig->render(
                'SelfEvaluation/selfEvaluationMain.html.twig',
                [
                    'selfevaluation' => $selfevaluation
                    
                ]
                )
            );
    }
    
   
    public function selfEvaluationMainEvalCategories(Environment $twig)
    {
        
        $repository = $this->getDoctrine()
        ->getRepository(SelfEvaluationCategories::class);
        $evalcategories = $repository->findAll();
        
        return new Response(
            $twig->render(
                'SelfEvaluation/selfEvaluationMainEvalCategories.html.twig',
                [
                    'evalcategories' => $evalcategories
                    
                ]
                )
            );
    }
    
    
    public function selfEvaluationAdd(Environment $twig, Request $request, UrlGeneratorInterface $urlGenerator)
    {
        $main = new SelfEvaluation();
        
        $form = $this->formFactory->create(SelfEvaluationForm::class, $main);
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $categorie = $form->get('categorieToAdd')->getData();
            
            $main->setCategorie($categorie);
            
            $this->manager->persist($main);
            $this->manager->flush();
            
            return new RedirectResponse($urlGenerator->generate('selfevaluation_main'));
            
        }
        
        
        
        return new Response(
            $this->twig->render('SelfEvaluation/selfEvaluationAdd.html.twig',
                ['form' => $form->createView()]));
    }

    
    public function selfEvaluationAddEvalCategories(Environment $twig, Request $request, UrlGeneratorInterface $urlGenerator)
    {
        $main = new SelfEvaluationCategories();
        
        $form = $this->formFactory->create(SelfEvaluationCategoriesForm::class, $main);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            
            $this->manager->persist($main);
            $this->manager->flush();
            
            return new RedirectResponse($urlGenerator->generate('selfevaluation_main_evalcategories'));
            
        }
        
        
        
        return new Response(
            $this->twig->render('SelfEvaluation/selfEvaluationAddEvalCategories.html.twig',
                ['form' => $form->createView()]));
    }
    
    
    
    
    
    
}

