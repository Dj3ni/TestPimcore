<?php

namespace App\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardController extends FrontendController
{
    #[Route('/auth/dashboard', name: 'dashboard')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('dashboard/index.html.twig',[
            'controller_name' => 'DashboardController',
        ]);
    }
}
