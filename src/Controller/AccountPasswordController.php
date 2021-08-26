<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountPasswordController extends AbstractController
{
    /**
     * @Route("/compte/modifier-mon-mot-de-passe", name="account_password")
     */
    public function index(): Response
    {   $User = $this->getUser();
        $form = $this-> createForm(ChangePasswordType::class,$User);
        return $this->render('account_controlleur/password.html.twig',['form'=>$form->createView()]);
    }
}
