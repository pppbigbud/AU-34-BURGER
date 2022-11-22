<?php

namespace App\Controller;

use App\Entity\Tacos;
use App\Form\TacosType;
use App\Repository\TacosRepository;
use App\Services\CartServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

//#[Route('/tacos')]

class TacosController extends AbstractController
{

    #[Route('/tacos', name: 'app_tacos_index')]
    public function index(Request          $request,
                          SessionInterface $session,
                          TacosRepository  $tacosRepository,
                          CartServices     $cartServices): Response
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

        $tacos = new Tacos();
        $form = $this->createForm(TacosType::class, $tacos);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $tacosRepository->save($tacos, true);
            $cartServices->addTacos($session, $tacos->getId());
        }
        return $this->render('tacos/index.html.twig', [
            'form' => $form->createView(),
            'tacos' => $tacos,
            'totalBurgerSideCart' => $totalBurgerSideCart,
            'totalTacosSideCart' => $totalTacosSideCart,
            'totalDrinkSideCart' => $totalDrinkSideCart,
        ]);
    }
}
