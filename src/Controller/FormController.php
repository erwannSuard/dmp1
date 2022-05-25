<?php

namespace App\Controller;
use App\Entity\Contact;
use App\Entity\Project;
use App\Entity\Funding;

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
        //Instantiation
        $contact = new Contact();
        $project = new Project();
        $funding = new Funding();



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
            // dd($project);
            
            $funding = $formProject->get('idFundingProject')->getData();
            $project = $formProject->getData();
            
            $project->setIdFundingProject($funding['project']);
            
            $em->persist($funding['project']);
            
            //--------------------------  ajout  --------------------------
            $contact = $formProject->get('idContact')->getData();
            $contact->addIdProject($project);
            $project->addIdContact($contact);
            // dd($contact);
            //--------------------------  Fin ajout  --------------------------
            //--------------------------  Original  --------------------------
            // $contact = $formProject->getData()->getIdContact()[0];
            // $contact->addIdProject($project);
            //--------------------------  Fin original  --------------------------
            //Boucler dans les WP :
            
            // dd($formProject['idRefProject']->getData());
            //!!!!!!!!!!!!!!!!!!!!!!!!!!!   à corriger  !!!!!!!!!!!!!!!!!!!!!!!!
            //Incrémenter l'index
            $i=0;
            foreach($formProject->get('idRefProject')->getData() as $wp)
            {
                
                $cct = new Contact();
                $cct = $formProject['idRefProject'][$i]['idContact']->getNormData();
                $workPackage = new Project();
                $workPackage = $wp;
                $workPackage->setIdRefProject($project);

                $cct->addIdProject($workPackage);
                $workPackage->addIdContact($cct);
                //JUSTE TANT QUE L'ACRONYME EST NON NULLABLE
                $workPackage->setAcronyme($project->getAcronyme());
                // dd($workPackage);
                $em->persist($workPackage);
                $em->persist($cct);
                $i+=1;
            }


            $em->persist($project);
            $em->flush();
            dd($project);
            return $this->render('home/index.html.twig');
        }
        return $this->renderForm('form/form.html.twig', [
            'formProject' => $formProject,
            'formContact' => $formContact,
        ]);
    }
}
