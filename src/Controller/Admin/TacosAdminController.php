<?php

namespace App\Controller\Admin;

use App\Entity\Cheese;
use App\Entity\Meat;
use App\Entity\Sauce;
use App\Entity\Size;
use App\Form\CheeseType;
use App\Form\MeatType;
use App\Form\SauceType;
use App\Form\SizeType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[isGranted("ROLE_ADMIN")]
class TacosAdminController extends AbstractController
{
    #[Route('admin/tacos/new', name: 'app_tacos_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $size = new Size();
        $formSize = $this->createForm(SizeType::class, $size);
        $formSize->handleRequest($request);
        if ($formSize->isSubmitted() && $formSize->isValid()) {
            $entityManager->persist($size);
            $entityManager->flush();
        }

        $meat = new Meat();
        $formMeat = $this->createForm(MeatType::class, $meat);
        $formMeat->handleRequest($request);
        if ($formMeat->isSubmitted() && $formMeat->isValid()) {
            $entityManager->persist($meat);
            $entityManager->flush();
        }


        $sauce = new Sauce();
        $formSauce = $this->createForm(SauceType::class, $sauce);
        $formSauce->handleRequest($request);
        if ($formSauce->isSubmitted() && $formSauce->isValid()) {
            $entityManager->persist($sauce);
            $entityManager->flush();
        }


        $cheese = new Cheese();
        $formCheese = $this->createForm(CheeseType::class, $cheese);
        $formCheese->handleRequest($request);
        if ($formCheese->isSubmitted() && $formCheese->isValid()) {
            $entityManager->persist($cheese);
            $entityManager->flush();
        }

        return $this->renderForm('admin/tacos/new.html.twig', [
            'formSize' => $formSize,
            'formMeat' => $formMeat,
            'formSauce' => $formSauce,
            'formCheese' => $formCheese,
        ]);
    }
}
