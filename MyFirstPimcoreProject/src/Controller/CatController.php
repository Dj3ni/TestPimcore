<?php

namespace App\Controller;

use App\Entity\Cat;
use App\Repository\CatRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CatController extends AbstractController
{
    #[Route('/cats', name: 'cats')]
    public function index(
        CatRepository $catRepository
    ): Response
    {
        $cats = $catRepository->findAll() ?? [];


        return $this->render('cat/index.html.twig', [
            'controller_name' => 'CatController',
            'cats' => $cats,
        ]);
    }

    #[Route('/cats/add', name: 'add_cat')]
    public function addCat(): Response
    {
        $cat = new Cat();
        

        return $this->render('cat/add.html.twig', [
            'controller_name' => 'CatController',
        ]);
    }
}
