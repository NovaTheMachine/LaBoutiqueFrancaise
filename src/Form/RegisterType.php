<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
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
                'constraints' => [new Length( ['min'=> 3 ,'max'=> 20 ,
                'minMessage' => 'Votre prénom doit avoir au moins  {{ limit }} characteres',
                'maxMessage' => 'Votre prénom doit avoir au moins {{ limit }} caracteres',] ) ],
                'attr'=>['placeholder'=>'Saisissez votre prénom']])
            ->add('lastname',TextType::class,
                ['label'=> 'Nom',
                'constraints' => [new Length( ['min'=> 3 ,'max'=> 20 ,
                'minMessage' => 'Votre nom doit avoir au moins  {{ limit }} characteres',
                'maxMessage' => 'Votre nom doit avoir au moins {{ limit }} caracteres', ] ) ],
                'attr'=>['placeholder'=>'Saisissez votre nom']])
            ->add('email',EmailType::class,
                ['label'=> 'E-mail',
                'attr'=>['placeholder'=>'Saisissez votre adresse mail']])
            ->add('password',RepeatedType::class,
                ['type'=> PasswordType::class,
                'invalid_message'=>'les mots de passe doivent etre identiques',
                    'label'=> 'Mot de passe',
                    'required'=>'true',
                    'first_options' => [
                        'label' => 'Mot de passe',
                        'attr'=>['placeholder'=>'Saisissez votre mot de passe']],
                        'second_options' => [
                            'label' => 'Mot de passe',
                            'attr'=>['placeholder'=>'Confirmez votre mot de passe']]])
                        

                
                
                   
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
