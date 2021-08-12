<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountControlleurController extends AbstractController
{
    /**
     * @Route("/account", name="account")
     */
    public function index(): Response
    {
        return $this->render('account_controlleur/index.html.twig');
    }
}
