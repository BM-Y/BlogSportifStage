<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SouscriptionContollerController extends AbstractController
{
    #[Route('/souscription', name: 'app_souscription')]
    public function register( Request $request, UserPasswordHasherInterface $userpasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user= new User;
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $user->setPassword(
                $userpasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
                );
            $entityManager->persist($user);
            $entityManager->flush();

        }

        return $this->render('register/index.html.twig', [
            'UserType' => $form->createView(),
        ]);
    }
}
