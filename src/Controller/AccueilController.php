<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(ProductRepository $productRepository)
    {
        $coeur = $productRepository->findByCoeur();
        $date = $productRepository->findByDate();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'coeur'=>$coeur,
            'dates'=>$date,
        ]);
    }
}
