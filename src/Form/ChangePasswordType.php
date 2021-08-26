<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class,['label'=>'Email',
                'disabled'=> true
            ])
            
            ->add('firstname',TextType::class,['label'=>'Prénom',
                'disabled'=> true
            ])
            ->add('lastname',TextType::class,['label'=>'Nom',
                'disabled'=> true
            ])
            ->add('old_password',PasswordType::class,['mapped' => false ,'label'=>'Mon mot de passe','attr'=>
            [ 'plaeholder'=> 'veuillez saisir votre mot de passe'

                ]
            ])
            ->add('new_password',RepeatedType::class,
                ['type'=> PasswordType::class,
                'mapped' => false ,
                'invalid_message'=>'les mots de passe doivent etre identiques',
                'label'=> 'Mon nouveau ot de passe',
                'required'=>'true',
                'first_options' => [
                    'label' => 'Mon nouveau ot de passe',
                    'attr'=>['placeholder'=>'Saisissez votre nouveau mot de passe']
                ]
                ,'second_options' => [
                    'label' => 'Confirmez votre nouveau mot de passe',
                        'attr'=>['placeholder'=>'Confirmez votre nouveau mot de passe']
                        ]
                            ])
            ->add('submit',SubmitType::class,['label'=>"Mettre a jour"])
            ;

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
