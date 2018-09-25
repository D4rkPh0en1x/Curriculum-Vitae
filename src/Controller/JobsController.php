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


}
