<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AccountPasswordController extends AbstractController
{   
    private $entityManager;

     /**
     * @param $entityManager
     */

     public function __construct(EntityManagerInterface $EntityManager)
     {
        $this->entityManager = $EntityManager;
     }

    /**
     * @Route("/compte/modifier-mon-mot-de-passe", name="account_password")
     */
    public function index(Request $request,UserPasswordHasherInterface $encoder): Response
    {   $user = $this->getUser();
        $form = $this-> createForm(ChangePasswordType::class,$user);
        $form ->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $old_pwd = $form->get('old_password')->getData();

            if ($encoder->isPasswordValid($user,$old_pwd)){
                $new_pwd = $form->get('new_password')->getData();
                $password = $encoder->hashPassword($user, $new_pwd);
                $user->setPassword($password);
                $this->entityManager->flush();

            }
        }

        return $this->render('account_controlleur/password.html.twig',['form'=>$form->createView()]);
    }
}
