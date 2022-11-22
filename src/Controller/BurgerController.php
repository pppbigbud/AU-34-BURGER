<?php

namespace App\Controller;

use App\Entity\Burger;
use App\Entity\Frie;
use App\Form\BurgerType;
use App\Form\FrieType;
use App\Repository\BurgerRepository;
use App\Repository\FrieRepository;
use App\Services\CartServices;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/burger')]
class BurgerController extends AbstractController
{
    #[Route('/', name: 'app_burger_index', methods: ['GET'])]
    public function index(Session $session,
                          BurgerRepository $burgerRepository,
                          CartServices $cartServices,
                          Request $request): Response
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

//        --------------------------FORM FRIE-----------------------------

        $burger = new Burger();
        $form = $this->createForm(BurgerType::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $burgerRepository->save($burger, true);
            $cartServices->addFrie($session, $burger);
        }

        return $this->render('burger/index.html.twig', [
            'burgers' => $burgerRepository->findAll(),
            'totalBurgerSideCart' => $totalBurgerSideCart,
            'totalTacosSideCart'  => $totalTacosSideCart,
            'totalDrinkSideCart' => $totalDrinkSideCart,
            'form' => $form->createView(),
        ]);
    }

    #[isGranted("ROLE_ADMIN")]
    #[Route('/new', name: 'app_burger_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BurgerRepository $burgerRepository): Response
    {
        $burger = new Burger();
        $form = $this->createForm(BurgerType::class, $burger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $burgerRepository->save($burger, true);

            return $this->redirectToRoute('app_burger_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('burger/new.html.twig', [
            'burger' => $burger,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_burger_show', methods: ['GET'])]
    public function show(Burger $burger): Response
    {
        return $this->render('burger/show.html.twig', [
            'burger' => $burger,
        ]);
    }

#[isGranted("ROLE_ADMIN")]
    #[Route('/{id}/edit', name: 'app_burger_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Burger $burger, BurgerRepository $burgerRepository): Response
    {
        $form = $this->createForm(BurgerType::class, $burger);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $burgerRepository->save($burger, true);

            return $this->redirectToRoute('app_burger_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('burger/edit.html.twig', [
            'burger' => $burger,
            'form' => $form,
        ]);
    }


    #[Route('/{id}', name: 'app_burger_delete', methods: ['POST'])]
    public function delete(Request $request, Burger $burger, BurgerRepository $burgerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$burger->getId(), $request->request->get('_token'))) {
            $burgerRepository->remove($burger, true);
        }

        return $this->redirectToRoute('app_burger_index', [], Response::HTTP_SEE_OTHER);
    }
}
