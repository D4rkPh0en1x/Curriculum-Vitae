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
use App\Entity\AcquiredSkills;
use App\Manager\AcquireSkillsManager;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Hillrange\CKEditor\Form\CKEditorType;
use App\Entity\Languages;
use App\Entity\Hobbies;
use App\Entity\Web;
use App\Entity\SoftSkills;
use App\Entity\WebPortfolio;
use App\Form\WebPortfolioForm;
use App\Entity\WebPortfolioImages;
use App\Repository\WebPortfolioRepository;


class WebPortfolioController extends Controller
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
    
    public function webPortfolioMain(Environment $twig)
    {
        
        $repository = $this->getDoctrine()
        ->getRepository(WebPortfolio::class);
        $webportfolio = $repository->findAll();
        
        return new Response(
            $twig->render(
                'WebPortfolio/webPortfolioMain.html.twig',
                [
                    'webportfolio' => $webportfolio
                    
                ]
                )
            );
    }

    
    
    
    public function webPortfolioAdd(Environment $twig, Request $request, UrlGeneratorInterface $urlGenerator)
    {
        $main = new WebPortfolio();
        
        $form = $this->formFactory->create(WebPortfolioForm::class, $main);
        $form->handleRequest($request);
        
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            
            $this->manager->persist($main);
            $this->manager->flush();
            
            return new RedirectResponse($urlGenerator->generate('webportfolio_main'));
            
        }
        
        
        
        return new Response(
            $this->twig->render('WebPortfolio/webPortfolioAdd.html.twig',
                ['form' => $form->createView()]));
    }
    
    
    
    
    /**
     * @param Request  $request
     * @param WebPortfolio $webportfolioid
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     *
     * @Route("/webportfolio/images/add/{webportfolioid}", name="webportfolioimages_add")
     */
    public function webPortfolioAddImages(
        Request $request,
        WebPortfolio $webportfolioid,
        WebPortfolioRepository $repository,
        FormFactoryInterface $factory,
        ObjectManager $manager,
        UrlGeneratorInterface $urlGenerator
        ) {
            $editWebPortfolioId = $webportfolioid->getID();
            
            $webPortfolio = $repository->find($editWebPortfolioId);
            
            $webportfolioimage = new WebPortfolioImages();
            
            $builder = $factory->createBuilder(FormType::class, $webportfolioimage);
            $builder
            ->add('image', CKEditorType::class, array(
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
                $webportfolioimage->setWebportfolio($webPortfolio);
                $manager->persist($webportfolioimage);
                $manager->flush();
                return new RedirectResponse($urlGenerator->generate('webportfolio_main'));
            }
            
            return $this->render(
                'WebPortfolio/webPortfolioAddImages.html.twig',
                [
                    'form' => $form->createView(),
                    'routeAttr' => ['webportfolioid' => $webportfolioid->getId()],
                ]
                
                );
    }
    
    
}

