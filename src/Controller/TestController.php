<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;


class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function test(): Response
    {
        return $this->render('test/test.html.twig', []);
    }

    // получаем код двухфакторной аутентификации
    #[Route('/two_factor/{email}', name: 'two_factor2')]
    public function two_factor(UserRepository $usersRepository, $email)
    {
        $auth_code = $usersRepository->findByEmail($email)[0]->getEmailAuthCode();
        return $this->json(['auth_code' => $auth_code]);
    }
}
