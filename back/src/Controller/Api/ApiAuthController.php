<?php

namespace App\Controller\Api;

use App\Repository\UserRepository;
use App\Service\MailService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/v1/')]
class ApiAuthController extends AbstractController
{
    #[Route('login', name: 'v1_login', methods: ['POST'])]
    public function login(): ?JsonResponse
    {
        return null;
    }

    #[Route('forgot-password', name: 'v1_forgot_password', methods: ['POST'])]
    public function forgotPassword(UserRepository $repository, MailService $messageService, EntityManagerInterface $manager, Request $request): JsonResponse
    {
        // On récupère l'email
        $data = $request->getContent();
        $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        $email = strip_tags((string)$data['email']);

        // si c'est un email alors on va chercher l'utilisateur
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // On récupère l'utilisateur concerné
            $user = $repository->findOneBy(['email' => $email]);

            if ($user) {

                if ($user->getActive() || $user->getNeedToResetPassword()) {
                    // reset password token
                    $user->setResetPasswordToken($user->generatePassword(25));
                    $user->setDateRequestResetPassword(new \DateTime());

                    // sauvegarde en bdd
                    $manager->persist($user);
                    $manager->flush();

                    // Envoie Mail
                    $messageService->forgetEMail($user);

                    return new JsonResponse(['status' => 'success', 'message' => 'Email envoyé']);
                }
                return new JsonResponse(['status' => 'success', 'message' => 'Compte bloqué']);
            }
            return new JsonResponse(['status' => 'success', 'message' => 'Email inconnu']);
        }
        return new JsonResponse(['status' => 'error', 'message' => 'Email inconnu']);
    }

    #[Route('verif-password-token', name: 'v1_verif_password_token', methods: ['POST'])]
    public function resetPasswordForm(UserRepository $repository, Request $request): JsonResponse
    {
        // On récupère le token
        $data = $request->getContent();
        $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        $token = strip_tags((string)$data['token']);

        // On récupère l'utilisateur concerné
        $user = $repository->findOneBy(['resetPasswordToken' => $token]);

        if ($user) {
            if ($user->getActive() || $user->getNeedToResetPassword()) {

                // Lien dépassé ?
                $now = new DateTime();
                $interval = $user->getDateRequestResetPassword()->diff($now);
                if ($interval->i <= 60) {
                    return new JsonResponse([
                        'result' => 'match',
                        'user' => [
                            'email' => $user->getEmail(),
                            'token' => $user->getToken(),
                        ]
                    ]);
                }
            }
        }

        return new JsonResponse(['result' => 'no_match']);
    }

    #[Route('reset-password/{token}', name: 'v1_reset_password_action', methods: ['POST'])]
    public function changePassword(
        UserRepository $repository,
        Request $request,
        UserPasswordHasherInterface $hasher,
        EntityManagerInterface $manager,
        string $token
    ): JsonResponse
    {
        // On récupère le token
        $token = strip_tags($token);

        // On récupère le token
        $data = $request->getContent();
        $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);
        $userToken = strip_tags((string)$data['userToken']);

        // On récupère l'utilisateur concerné
        $user = $repository->findOneBy(['resetPasswordToken' => $token, 'token' => $userToken]);

        // si on a trouvé un utilisateur
        if ($user) {
            // s'il a la possibilité de changer son mot de passe (compte toujours actif ou nouveau)
            if ($user->getActive() || $user->getNeedToResetPassword()) {

                // Lien dépassé ?
                $now = new DateTime();
                $interval = $user->getDateRequestResetPassword()->diff($now);
                if ($interval->i <= 60) {

                    // tout est ok
                    $password = strip_tags((string)$data['password']);

                    $user->setPassword($hasher->hashPassword(
                        $user,
                        $password
                    ));
                    $user->setActive(true);
                    $user->setNeedToResetPassword(false);
                    $user->setResetPasswordToken($user->generatePassword(10) . '-done');

                    $manager->persist($user);
                    $manager->flush();
                    return new JsonResponse(['status' => 'success', 'msg' => 'ok']);
                }
                return new JsonResponse(['status' => 'error', 'msg' => 'Timeout']);
            }
            return new JsonResponse(['status' => 'error', 'msg' => 'Account blocked']);
        }
        return new JsonResponse(['status' => 'error', 'msg' => 'No user']);
    }
}
