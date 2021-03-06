<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
      
    /**
     * @Route("/inscription", name="register")
     */
    public function index(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $user = new User();
        $form = $this->createForm (RegisterType::class,$user);
        $form -> handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $user = $form->getData();
            $password = $encoder->encodePassword($user,$user->getPassword());
            $user->setPassword($password);
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine ->persist($user);
            $doctrine ->flush();
        }
        return $this->render('register/index.html.twig',['formulaire'=>$form->createView()]);
    }
}
