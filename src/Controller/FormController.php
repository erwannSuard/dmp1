<?php

namespace App\Controller;
use App\Entity\Contact;
use App\Entity\Project;

use App\Form\ContactType;
use App\Form\ProjectType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormController extends AbstractController
{
    #[Route('/form', name: 'app_form')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        //PROJECT
        $em = $doctrine->getManager();
        $contact = new Contact();
        $project = new Project();
        
        $formProject = $this->createForm(ProjectType::class, $project);
        $formProject->handleRequest($request);
        
        $formContact = $this->createForm(ContactType::class, $contact);
        $formContact->handleRequest($request);

        if($formContact->isSubmitted() && $formContact->isValid())
        {
            $contact = $formContact->getData();
            $em->persist($contact);
            $em->flush();
            unset($contact);
            unset($formContact);
            $contact = new Contact();
            $formContact = $this->createForm(ContactType::class, $contact);
            return $this->renderForm('form/form.html.twig', [
                'formProject' => $formProject,
                'formContact' => $formContact,
            ]);
        }


        if($formProject->isSubmitted() && $formProject->isValid())
        {
            
            $project = $formProject->getData();
            $contact = $formProject->getData()->getIdContact()[0];
            $contact->addIdProject($project);

            //Boucler dans les WP :
            foreach($formProject->get('idRefProject')->getData() as $wp)
            {
                $workPackage = new Project();
                $workPackage = $wp;
                $workPackage->setIdRefProject($project);
                //JUSTE TANT QUE L'ACRONYME EST NON NULLABLE
                $workPackage->setAcronyme($project->getAcronyme());
                $em->persist($workPackage);
            }


            $em->persist($project);
            $em->flush();
            // dd($project);
            return $this->render('home/index.html.twig');
        }
        return $this->renderForm('form/form.html.twig', [
            'formProject' => $formProject,
            'formContact' => $formContact,
        ]);
    }
}
