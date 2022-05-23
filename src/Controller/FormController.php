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
        // $contact = new Contact();
        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $project = $form->getData();
            $em->persist($project);
            $em->flush();

            return $this->render('home/index.html.twig');
        }
        return $this->renderForm('form/form.html.twig', [
            'form' => $form,
        ]);
    }
}
