<?php

namespace App\Controller;

use App\Entity\Cars;
use App\Entity\Prestations;
use App\Repository\CarsRepository;
use App\Repository\OpeningHoursRepository;
use App\Repository\PrestationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PrestationsController extends AbstractController
{
    #[Route('/prestations/{id}', name: 'app_show_prestations')]
    public function showPrestations(OpeningHoursRepository $openingHoursRepository, PrestationsRepository $prestationsRepository, Prestations $prestation, CarsRepository $carsRepository): Response
    {
        $cars = $carsRepository->findBy([],['id' => 'ASC']);
        $prestationList = $prestationsRepository->findBy([],['id' => 'ASC']);
        $openingHourList = $openingHoursRepository->findBy([],['id' => 'ASC']);

        dump($prestationList, $prestation);

        return $this->render('prestations/show_prestations.html.twig', [
            'cars' => $cars,
            'prestation' => $prestation,
            'prestationList' => $prestationList,
            'openingHourList' => $openingHourList,
        ]);
    }
}
