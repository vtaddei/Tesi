<?php

namespace App\Controller;

use App\Entity\Athletes;
use App\Form\AthletesFormType;
use App\Repository\AthletesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AthletesController extends \Symfony\Bundle\FrameworkBundle\Controller\AbstractController
{
    #[Route('/Atleta', name: 'CreaUtente')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): \Symfony\Component\HttpFoundation\Response
    {
        $usr = new Athletes();
        $form = $this->createForm(AthletesFormType::class, $usr);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usr->setPassword(
                $userPasswordHasher->hashPassword(            #non è mappato infatti dal form
                    $usr,
                    $form->get('password')->getData()
                )
            );
            $entityManager->persist($usr);
            $entityManager->flush();
            return $this->redirectToRoute('HomePage');
        }

        return $this->render('CreaUtente.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/dashboard', name: 'DashBoard')]
    public function ShowDash(): Response
    {
        return $this->render('DashBoard.html.twig');
    }

}