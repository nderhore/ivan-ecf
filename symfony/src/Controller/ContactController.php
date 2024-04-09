<?php

namespace App\Controller;

use App\Entity\Contacts;
use App\Form\ContactType;
use App\Repository\ContactsRepository;
use App\Repository\OpeningHoursRepository;
use App\Repository\PrestationsRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Builder\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function showContactForm(PrestationsRepository $prestationsRepository, 
    OpeningHoursRepository $openingHoursRepository,
    Request $request, EntityManagerInterface $entityManagerInterface,
    ContactsRepository $contactsRepository, Security $security): Response
    {
        $openingHourList = $openingHoursRepository->findBy([],['id' => 'ASC']);
        $prestationList = $prestationsRepository->findBy([],['id' => 'ASC']);

        $user = $security->getUser();

        $contact = new Contacts();
        $contactForm = $this->createForm(ContactType::class, $contact);
        $contactForm->handleRequest($request);

        $formList = $contactsRepository->findBy([],['id' => 'ASC']);


        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $entityManagerInterface->persist($contact);
            $entityManagerInterface->flush();
        }
        
        return $this->render('contact/show_contact_form.html.twig', [
            'controller_name' => 'ContactController',
            'contactForm' => $contactForm,
            'openingHourList' => $openingHourList,
            'prestationList' => $prestationList,
            'user' => $user,
            'formList' => $formList,
        ]);
    }

    #[Route('/contact/{id}', name: 'app_contact_delete', methods: ['DELETE'])]
    public function delete(Contacts $contacts, EntityManagerInterface $em) {
        $em->remove($contacts);
        $em->flush();

        $this->addFlash('success', 'Le formulaire de contact a bien été supprimé');
        return $this->redirectToRoute('app_contact');
    }

}