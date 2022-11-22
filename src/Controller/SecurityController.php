<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, SessionInterface $session): Response
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

        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername, 'error' => $error,
            'totalBurgerSideCart' => $totalBurgerSideCart,
            'totalTacosSideCart'  => $totalTacosSideCart,
            'totalDrinkSideCart' => $totalDrinkSideCart,
        ]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
