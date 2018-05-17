<?php
namespace App\Controller;

use Twig\Environment;
use Symfony\Component\HttpFoundation\Response;
use App\Form\MainForm;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use App\Entity\Main;
use App\Form\UserFormType;
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


class MainController extends Controller
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
    
    public function welcome(Environment $twig)
    {

        $repository = $this->getDoctrine()
        ->getRepository(Main::class);
        $maintext = $repository->findBy([], ['id' => 'ASC']);
        
        
  
        
        return new Response(
            $twig->render(
                'Main/homepage.html.twig',
            [
                'maintext' => $maintext
 
            ]
            )
            );
    }
    
  
    
    
    
    
    
    public function mainAdd(Environment $twig, Request $request, UrlGeneratorInterface $urlGenerator)
    {
    $main = new Main();
        
    $form = $this->formFactory->create(MainForm::class, $main);
    $form->handleRequest($request);
    
    
    if ($form->isSubmitted() && $form->isValid()) {

    
        $this->manager->persist($main);
        $this->manager->flush();
    return new RedirectResponse($urlGenerator->generate('homepage'));
        
    }
    
    
    
    return new Response(
        $this->twig->render('Main/mainAdd.html.twig', 
        ['form' => $form->createView()]));
    }
    
    
}

