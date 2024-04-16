<?php

namespace App\Controller;

use App\Entity\Opinions;
use App\Form\OpinionType;
use App\Repository\OpeningHoursRepository;
use App\Repository\OpinionsRepository;
use App\Repository\PrestationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\Length;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        Security $security, 
        PrestationsRepository $prestationsRepository,
        OpeningHoursRepository $openingHoursRepository,
        OpinionsRepository $opinionsRepository,
    ): Response

    {
        $openingHourList = $openingHoursRepository->findBy([],['id' => 'ASC']);
        $prestationList = $prestationsRepository->findBy([],['id' => 'ASC']);
       
        $user = $security->getUser();

        // For the display of the opinions
        $opinionsValidated = $opinionsRepository->getValidatedOpinions();
        if (count($opinionsValidated) > 0) {
            $opinionToDisplay = $opinionsValidated[0];
            $averageGrade = $opinionsRepository->getAverageGrade();
        }
        else {
            $opinionToDisplay = null;
            $averageGrade = '5';
        }
        
        dump($opinionsValidated, $opinionToDisplay);   

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'openingHourList' => $openingHourList,
            'prestationList' => $prestationList,
            'user' => $user,
            'opinionToDisplay' => $opinionToDisplay,
            'averageGrade' => $averageGrade,
        ]);
    }
}
