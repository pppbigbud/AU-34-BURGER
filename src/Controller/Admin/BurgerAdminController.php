<?php

namespace App\Controller\Admin;

use App\Entity\Burger;
use App\Form\BurgerType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class BurgerAdminController extends AbstractController
{
    public function __construct(
        private ParameterBagInterface  $parameterBag,
        private EntityManagerInterface $entityManager,
    )
    {
    }

    #[isGranted("ROLE_ADMIN")]
    #[Route('admin/burger/new', name: 'app_burger_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $burgerDirectoryPath = $this->parameterBag->get('burger_directory');
        $burger = new Burger();
        $form = $this->createForm(BurgerType::class, $burger);
        $form->handleRequest($request);

        $burgerImgFile = $form->get('imageFile')->getData();

        if ($burgerImgFile) {
            //exemple de nom de fichier : chat.jpg
            //recupére le nom du fichier sans l'extension => chat
            $originalFilename = pathinfo($burgerImgFile->getClientOriginalName(), PATHINFO_FILENAME);

            //Slug l'originalName, exemple: chat noir -> chat-noir
            $safeFilename = $slugger->slug($originalFilename);

            // vrai nom de fichier unique, exemple chat-noir -> chat-noir-fkljfdljfdlkj.jpg
            $newFileName = $safeFilename . '-' . uniqid() . '.' . $burgerImgFile->guessExtension();

            try {
                $burgerImgFile->move(
                    $burgerDirectoryPath,
                    $newFileName
                );

                $burger->setImagePath($newFileName);
                $this->entityManager->persist($burger);
                $this->entityManager->flush();
            } catch (\Exception $e) {

            }
        }

        return $this->renderForm('admin/new.html.twig', [
            'form' => $form,
        ]);
    }

}
