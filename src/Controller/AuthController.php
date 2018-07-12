<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends Controller {
    /** @Route("/login", name="login") */
    public function loginCheck(Request $request, AuthenticationUtils $utils){
        // get the login error if there is one
        $error = $utils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $utils->getLastUsername();

        return $this->render('test.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
}