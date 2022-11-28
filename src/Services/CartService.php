<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CartService
{
    public function addBurger(SessionInterface $session, string $id): void
    {
        $panier = $session->get('panier', []);

        if (!empty($panier['burger'][$id])) {
            $panier['burger'][$id]++;

        } else {

            $panier['burger'][$id] = 1;
        }

        $session->set('panier', $panier);
    }

    public function addTacos(SessionInterface $session, string $id): void
    {
        $panier = $session->get('panier', []);

        if (!empty($panier['tacos'][$id])) {
            $panier['tacos'][$id]++;

        } else {

            $panier['tacos'][$id] = 1;
        }

        $session->set('panier', $panier);
    }

    public function addDrink(SessionInterface $session, string $id): void
    {
        $panier = $session->get('panier', []);

        if (!empty($panier['drink'][$id])) {
            $panier['drink'][$id]++;

        } else {

            $panier['drink'][$id] = 1;
        }

        $session->set('panier', $panier);
    }


//    public function addFrie(SessionInterface $session): void
//    {
//        $panier = $session->get('panier', []);
//
//        if (!empty($panier['frie'])) {
//            $panier['frie']++;
//
//        } else {
//
//            $panier['frie'] = 1;
//        }
//
//        $session->set('panier', $panier);
//    }


}