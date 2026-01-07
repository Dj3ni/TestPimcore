<?php

namespace App\Controller;

use Pimcore\Controller\FrontendController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

#[Route('/auth', name: 'simple_auth_')]
class AuthController extends FrontendController
{
    #[Route('/login', name: 'login')]
    public function login(
        Request $request,
        AuthenticationUtils $authenticationUtils,
        UserInterface|null $user = null
    ): Response
    {
        if($this->getUser() && $this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('dashboard');
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('auth/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,        
        ]);
    }

    #[Route('/register', name: 'register')]
    public function register(): Response
    {
        return $this->render('auth/register.html.twig', [
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
        return $this->redirectToRoute('simple_auth_login');
    }

}
