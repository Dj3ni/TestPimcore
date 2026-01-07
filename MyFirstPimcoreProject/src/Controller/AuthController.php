<?php

namespace App\Controller;

use App\Model\DataObject\User;
use Pimcore\Controller\FrontendController;
use Pimcore\Model\Element\Service as Service;
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
    public function register(Request $req): Response
    {
        // dd($req);
        if($req->get('Register')) {

            $pwd = $req->get('password');
            $pwdConfirm = $req->get('passwordConfirm');

            if($pwd !== $pwdConfirm) {
                // Handle password mismatch
                $this->addFlash('error', 'Passwords do not match.');
                return $this->redirectToRoute('simple_auth_register');
            }

            if($pwd === '' || $pwdConfirm === '') {
                // Handle empty password fields
                $this->addFlash('error', 'Password fields cannot be empty.');
                return $this->redirectToRoute('simple_auth_register');
            }

            $user = User::getByUsername($req->get('email'),1);
            if($user instanceof User ) {
                // Handle existing username
                $this->addFlash('error', 'Username already exists.');
                return $this->redirectToRoute('simple_auth_register');
            }

            // Create user and persist to database
            $user = new User();
            $user->setParentId(2); // Assuming 2 is the ID of the folder where users are stored
            $user->setPublished(true);
            $user->setKey(Service::getValidKey($req->get('email'), 'object'));
            $user->setUsername($req->get('email'));
            $user->setPassword($pwd);
            $user->save();

            $this->addFlash('success', 'Registration successful');
            return $this->redirectToRoute('simple_auth_login');
        
        }

        return $this->render('auth/register.html.twig', [
        ]);
    }

    #[Route('/logout', name: 'logout')]
    public function logout(): Response
    {
        return $this->redirectToRoute('simple_auth_login');
    }

}
