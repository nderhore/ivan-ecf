<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\CarsRepository;

class CarController extends AbstractController{

    #[Route('/filter-car}', name: 'filter_car')]
    public function filterCars(Request $request, CarRepository $carRepository): Response
    {

        // Récuperer les critères
        $km = $request->query->get('km');
        $year = $request->query->get('year');
        $price = $request->query->get('price');

        //Filtrer les voitures
        $filteredCars = $carRepository->findByCriteria($km,$year,$price);

        //Transformer les voitures reçu de la bdd en objet json
        $carArray = [];
        foreach ($filteredCars as $car) {
            $carArray[] = [
                'id' => $car->getId(),
                'title' => $car->getTitle(),
                'build_year' => $car->getBuildYear(),
                'fuel' => $car->getFuel(),
                'kilometer' => $car->getKilometer(),
                'price' => $car->getPrice(),
                'imageName' => $car->getImageName(),
                'imageSize' => $car->getImageSize(),
                'updatedAt' => $car->getUpdatedAt() ? $car->getUpdatedAt()->format('Y-m-d H:i:s') : null,
            ];
        }

        return new JsonResponse($carArray);
    }
}

