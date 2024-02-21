<?php

namespace App\Controller;

use App\Entity\OpeningHours;
use App\Entity\OurServices;
use App\Entity\Prestations;
use App\Entity\Services;
use App\Repository\CarsRepository;
use App\Repository\OpeningHoursRepository;
use App\Repository\PrestationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PrestationsRepository $prestationsRepository, 
    OpeningHoursRepository $openingHoursRepository): Response
    {
        $openingHourList = $openingHoursRepository->findBy([],['id' => 'ASC']);
        $prestationList = $prestationsRepository->findBy([],['id' => 'ASC']);
        
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'openingHourList' => $openingHourList,
            'prestationList' => $prestationList,
        ]);
    }
}
