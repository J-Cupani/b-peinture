<?php

namespace App\Controller\Api;

use App\Repository\ProjectRepository;
use App\Service\FileUploaderService;
use App\Service\MailService;
use App\Service\SerializeDataToJsonService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('PUBLIC_ACCESS')]
#[Route('/v1/public/')]
class ApiPublicController extends AbstractController
{
    public function __construct(
        protected EntityManagerInterface     $manager,
        protected FileUploaderService        $fileUploader,
        protected SerializeDataToJsonService $serializeData,
    ) {
    }

    #[Route(path: 'get-all-project', methods: ['GET'])]
    public function getAll(ProjectRepository $projectRepository): JsonResponse
    {
        // Récupérer uniquement les projets actifs
        $projects = $projectRepository->findActiveProjects();

        // Transformer les projets pour les retourner
        $data = array_map(fn($project) => $this->serializeData->getProjectJson($project, 'list'), $projects);

        return new JsonResponse([
            'success' => true,
            'projects' => $data
        ]);
    }

    #[Route('send-mail', methods: ['POST'])]
    public function sendMail(
        Request $request,
        MailService $mailer,
    ): JsonResponse {

        // Récupération des données de la requête
        $data = json_decode($request->getContent(), true);

        // Vérification des champs obligatoires
        if (empty($data['name']) || empty($data['email']) || empty($data['subject']) || empty($data['message'])) {
            return new JsonResponse(['error' => 'Tous les champs obligatoires doivent être remplis.'], 400);
        }

        // Envoi de l'email
        try {
            // Utilisation du service pour envoyer l'e-mail
            $mailer->sendContactEmail(
                $data['subject'], // Sujet de l'e-mail
                [
                    'name' => $data['name'],
                    'userEmail' => $data['email'],
                    'message' => $data['message'],
                    'phone' => $data['phone'],
                    'ip' => $request->getClientIp(),
                ]
            );

            return new JsonResponse(['message' => 'Votre message a été envoyé avec succès.'], 200);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e], 500);
        }
    }
}
