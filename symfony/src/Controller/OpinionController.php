<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Entity\Opinions;
use App\Form\OpinionType;
use App\Repository\OpeningHoursRepository;
use App\Repository\OpinionsRepository;
use App\Repository\PrestationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OpinionController extends AbstractController
{

    // Function to display the opinion form

    #[Route('/opinion', name: 'app_opinion')]
    public function showOpinionForm(
        PrestationsRepository $prestationsRepository, 
        OpeningHoursRepository $openingHoursRepository,
        Request $request, 
        EntityManagerInterface $entityManagerInterface,
        OpinionsRepository $opinionsRepository,
        Security $security,
    ): Response

    {
        // Informations for the header and the footer
        $openingHourList = $openingHoursRepository->findBy([],['id' => 'ASC']);
        $prestationList = $prestationsRepository->findBy([],['id' => 'ASC']);

        $user = $security->getUser();

        // List of the existing opinion form
        $opinionsFormList = $opinionsRepository->findBy([],['id' => 'ASC']);

        
        // Informations for the opinion form
        $opinion = new Opinions();
        $opinionForm = $this->createForm(OpinionType::class, $opinion);
        $opinionForm->handleRequest($request);

        // Submission of the contact form
        if ($opinionForm->isSubmitted() && $opinionForm->isValid()) {
            $entityManagerInterface->persist($opinion);
            $entityManagerInterface->flush();

            $this->addFlash('success', 'Votre commentaire a bien été envoyé');
        }
        
        return $this->render('opinion/show_opinion_form.html.twig', [
            'controller_name' => 'ContactController',
            'opinionForm' => $opinionForm,
            'openingHourList' => $openingHourList,
            'prestationList' => $prestationList,
            'user' => $user,
            'opinionsFormList' => $opinionsFormList,
        ]);
    }

    // Delete function : remove contact form

    #[Route('/opinion/delete/{id}', name: 'app_opinion_delete', methods: ['DELETE'])]
    public function delete(Opinions $opinions, EntityManagerInterface $em) {
        $em->remove($opinions);
        $em->flush();

        $this->addFlash('success', 'Votre avis a bien été supprimé');
        return $this->redirectToRoute('app_opinion');
    }
}