<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(SessionInterface $session): Response
    {
        $totalBurgerSideCart = 0;
        $totalTacosSideCart = 0;
        $totalDrinkSideCart = 0;

// ---------------------------SESSION SIDECART---------------------------------------------------

        $sessionPanier = ($session->get('panier'));

        if ($sessionPanier === null) {
            $totalArticles = 0;
        } else {
            if (isset($sessionPanier['tacos'])) {
                $totalTacosSideCart = array_sum($sessionPanier['tacos']);
            }
            if (isset($sessionPanier['burger'])){
                $totalBurgerSideCart = array_sum($sessionPanier['burger']);
            }
            if (isset($sessionPanier['drink'])){
                $totalDrinkSideCart = array_sum($sessionPanier['drink']);
            }
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'totalBurgerSideCart' => $totalBurgerSideCart,
            'totalTacosSideCart'  => $totalTacosSideCart,
            'totalDrinkSideCart' => $totalDrinkSideCart,
        ]);
    }
}
