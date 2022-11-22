<?php

namespace App\Controller;

use App\Repository\DrinkRepository;
use App\Repository\TacosRepository;
use App\Services\CartServices;
use App\Repository\BurgerRepository;
//use Flasher\Prime\Flasher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/panier', name: 'app_cart')]
    public function index(SessionInterface $session,
                          BurgerRepository $burgerRepository,
                          TacosRepository  $tacosRepository,
                          DrinkRepository  $drinkRepository
    ): Response
    {
        $panierWithData = [];
        $panierWithData['tacos'] = [];
        $panierWithData['burger'] = [];
        $panierWithData['drink'] = [];

        $totalBurger = 0;
        $totalTacos = 0;
        $totalDrink = 0;
        $totalArticles = 0;

        $totalBurgerSideCart = 0;
        $totalTacosSideCart = 0;
        $totalDrinkSideCart = 0;

// ---------------------------SESSION SIDECART---------------------------------------------------

        $sessionPanier = ($session->get('panier'));

        if ($sessionPanier === []) {
            $totalArticles = 0;
        } else {
            if (isset($sessionPanier['tacos'])&& empty($sessionPanier['tacos'])) {
                $totalTacosSideCart = array_sum($sessionPanier['tacos']);
            }
            if (isset($sessionPanier['burger'])&& empty($sessionPanier['burger'])){
                $totalBurgerSideCart = array_sum($sessionPanier['burger']);
            }
            if (isset($sessionPanier['drink'])&& empty($sessionPanier['drink'])){
                $totalDrinkSideCart = array_sum($sessionPanier['drink']);
            }
        }

// ---------------------------SESSION CART BURGER et TACOS---------------------------------------------------

        $panier = $session->get('panier', []);

        foreach ($panier as $typeProduits => $produits) {

            if ($typeProduits === 'burger') {
                foreach ($produits as $burgerId => $quantity) {
                    $burger = $burgerRepository->find($burgerId);
                    $panierWithData['burger'][] = [
                        'burger' => $burger,
                        'quantity' => $quantity,
                    ];

                    $totalBurger += $burger->getPrice() * $quantity;
                }

            } else if ($typeProduits === 'tacos') {
                foreach ($produits as $tacosId => $quantity) {
                    $tacos = $tacosRepository->find($tacosId);
                    $panierWithData['tacos'][] = [
                        'tacos' => $tacos,
                        'quantity' => $quantity,
                    ];
                    $tacosPrice = ($tacos->getSize()->getPrice()) + ($tacos->getMeat()->getPrice());

                    $totalTacos += $tacosPrice * $quantity;
                }

            } else if ($typeProduits === 'drink') {
                foreach ($produits as $drinkId => $quantity) {
                    $drink = $drinkRepository->find($drinkId);
                    $panierWithData['drink'][] = [
                        'drink' => $drink,
                        'quantity' => $quantity,
                    ];
                    $drinkPrice = $drink->getPrice() * $quantity;

                    $totalDrink += $drinkPrice * $quantity;
                }
            }
        }

        dump($panierWithData['drink']);

            return $this->render('cart/index.html.twig', [
                'itemsTotal' => $totalBurger + $totalTacos + $totalDrink,
                'itemsBurger' => $panierWithData['burger'],
                'itemsTacos' => $panierWithData['tacos'],
                'itemsDrink' => $panierWithData['drink'],
                'totalBurger' => $totalBurger,
                'totalTacos' => $totalTacos,
                'totalDrink' => $totalDrink,
                'items' => $panier,
                'session' => $session,
                'totalArticles' => $totalArticles,
                'totalBurgerSideCart' => $totalBurgerSideCart,
                'totalTacosSideCart' => $totalTacosSideCart,
                'totalDrinkSideCart' => $totalDrinkSideCart,

            ]);
        }
//    ----------------------AJOUT et SUP BURGER--------------------------

        #[Route('/panier/add/burger/{id}', name: 'cart_add_burger_id')]
    public function addBurger(SessionInterface $session, CartServices $cartServices, $id): Response
    {
        $cartServices->addBurger($session, $id);

        return $this->redirectToRoute('app_burger_index');
    }

    #[Route('/panier/remove/burger/{id}', name: 'cart_remove_burger')]
    public function removeBurger($id, SessionInterface $session): Response
    {
        $panier = $session->get('panier', []);

        if (!empty($panier['burger'][$id])) {
            unset($panier['burger'][$id]);
        }
        $session->set('panier', $panier);

        return $this->redirectToRoute('app_cart', []);
    }

//    ----------------------AJOUT et SUP TACOS--------------------------

//    #[Route('/panier/add/tacos/{id}', name: 'cart_add_tacos_id')]
//    public function addTacos(SessionInterface $session, CartServices $cartServices, $id): Response
//    {
//        $cartServices->addTacos($session, $id);
//
//        return $this->redirectToRoute('app_tacos_index');
//    }

    #[Route('/panier/remove/tacos/{id}', name: 'cart_remove_tacos')]
    public function removeTacos($id, SessionInterface $session): Response
    {
        $panier = $session->get('panier', []);

        if (!empty($panier['tacos'][$id])) {
            unset($panier['tacos'][$id]);
        }
        $session->set('panier', $panier);

        return $this->redirectToRoute('app_cart', []);
    }

//    ----------------------AJOUT et SUP DRINK--------------------------


    #[Route('/panier/add/drink/{id}', name: 'cart_add_drink_id')]
    public function addDrink(SessionInterface $session, CartServices $cartServices, $id): Response
    {
        $cartServices->addDrink($session, $id);

        return $this->redirectToRoute('app_drink_index');
    }

    #[Route('/panier/remove/drink/{id}', name: 'cart_remove_drink')]
    public function removeDrink($id, SessionInterface $session): Response
    {
        $panier = $session->get('panier', []);

        if (!empty($panier['drink'][$id])) {
            unset($panier['drink'][$id]);
        }
        $session->set('panier', $panier);

        return $this->redirectToRoute('app_cart', []);
    }


}



//-------------------------------------FLASHER------------------------------------------

//        $product = $burgerRepository->find($id);
//        $productName = $product->getName();
//
//        $panier = $session->get('panier', []);
//
//        if (!empty($panier[$id])) {
//            $panier[$id]++;
//
//            $this->addFlash('success', 'Le 🍔' . $productName . '🍔 est ajouté à votre panier  ');
//
//        } else {
//            $panier[$id] = 1;
//        }
//
//        $session->set('panier', $panier);
//        Flasher $flasher, SessionInterface $session, BurgerRepository $burgerRepository
