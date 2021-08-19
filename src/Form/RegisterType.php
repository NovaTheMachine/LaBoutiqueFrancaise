<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname',TextType::class,[
                'label'=> 'Prénom',
                'constraints' => [new Length( ['min'=> 2 ,'max'=> 20 ] ) ],
                'attr'=>['placeholder'=>'Saisissez votre prénom']])
            ->add('lastname',TextType::class,
                ['label'=> 'Nom',
                'constraints' => [new Length( ['min'=> 2 ,'max'=> 20 ] ) ],
                'attr'=>['placeholder'=>'Saisissez votre nom']])
            ->add('email',EmailType::class,
                ['label'=> 'E-mail',
                'attr'=>['placeholder'=>'Saisissez votre adresse mail']])
            ->add('password',PasswordType::class,
                ['label'=> 'Mot de passe',
                'constraints' => [new Length( ['min'=> 2 ,'max'=> 20 ] ) ],
                'attr'=>['placeholder'=>'Creez votre mot de passe']])
            ->add('passwordConfirm',PasswordType::class,
                ['label'=> 'Confirmez',
                'mapped' => false,
                'attr'=>['placeholder'=>'Confirmez votre mot de passe']])
                   
            ->add('submit',SubmitType::class,['label'=>"S'inscrire"])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
