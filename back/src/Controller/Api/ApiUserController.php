<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Service\FileUploaderService;
use App\Service\SerializeDataToJsonService;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/v1/user/')]
class ApiUserController extends AbstractController
{
    public function __construct(
        protected EntityManagerInterface     $manager,
        protected FileUploaderService        $fileUploader,
        protected SerializeDataToJsonService $serializeData,
        protected JWTTokenManagerInterface   $jwtManager,
    ) {
    }

    #[Route('me', methods: ['GET'])]
    public function me(#[CurrentUser] ?User $user): JsonResponse
    {
        return new JsonResponse($this->serializeData->getUserJson($user));
    }

    #[IsGranted('me', 'user')]
    #[Route('edit-password/{token}', methods: ['POST'])]
    public function editPassword(User $user, Request $request, UserPasswordHasherInterface $hasher): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $password = strip_tags($data['password']);

        // Expression régulière pour valider le mot de passe sans majuscule
        $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

        // Validation du mot de passe
        if (!preg_match($passwordPattern, $password)) {
            return new JsonResponse(['status' => 'error']);
        }

        // Si le mot de passe est valide, on continue avec le hachage
        $user->setPassword($hasher->hashPassword($user, $password));

        // Sauvegarde de l'utilisateur avec le nouveau mot de passe
        $this->manager->persist($user);
        $this->manager->flush();

        return new JsonResponse(['status' => 'success']);
    }

    #[Route(path: 'get-all-user', methods: ['GET'])]
    public function getAll(#[CurrentUser] ?User $user, UserRepository $userRepository): JsonResponse
    {
        // Vérification des droits d'accès
        if (!$this->isGranted('ROLE_SUPER_ADMIN')) {
            return new JsonResponse([
                'success' => false,
                'message' => 'Accès refusé. Vous devez être administrateur pour accéder à cette ressource'
            ]);
        }

        // Récupération des utilisateurs ayant le rôle 'ROLE_SUPER_ADMIN'
        $data = [];

        foreach ($userRepository->findByRole('ROLE_SUPER_ADMIN') as $item) {
            if ($user !== $item) {
                $data[] = $this->serializeData->getUserJson($item, 'list');
            }
        }

        return new JsonResponse([
            'success' => true,
            'data' => $data
        ]);
    }

    #[Route('upsert', methods: ['POST'])]
    public function upsert(
        UserPasswordHasherInterface $hasher,
        Request                     $request,
        FileUploaderService         $fileUploader,
        ValidatorInterface          $validator,
        UserRepository              $userRepository,
        #[CurrentUser] ?User        $currentUser,
    ): JsonResponse
    {
        $action = 'new';
        $token = $request->request->get('token', '');

        if ($token === '') {
            $user = new User();
        } else {
            $action = 'edit';

            $user = $userRepository->findOneBy(['token' => $token]);

            if (!$user) {
                return new JsonResponse(['status' => 'error', 'messages' => ["Utilisateur non trouvé"]]);
            }

            if (!$this->isGranted('edit', $user) && !$this->isGranted('me', $user)) {
                return new JsonResponse(['status' => 'error', 'messages' => ['Accès refusé.']]);
            }
        }

        $user->setFirstName($request->request->get('firstName'));
        $user->setLastName($request->request->get('lastName'));
        $user->setActive($request->request->getBoolean('active'));
        $user->setEmail($request->request->get('email'));

        // Admin
        if ($this->isGranted('ROLE_SUPER_ADMIN')) {
            if ($user !== $currentUser) {
                $user->setRoles(["ROLE_SUPER_ADMIN"]);
            }
        }

        // Si on est en création, on crée un nouveau mot de passe et on ajoute le role spécifique
        if ($action === 'new') {
            $user->setPassword($hasher->hashPassword(
                $user,
                $user->generatePassword()
            ));
        }

        // test si on as un fichier
        $file = $request->request->all('file');

        if ($action === 'edit' && (array_key_exists("isDelete", $file) && filter_var($file["isDelete"], FILTER_VALIDATE_BOOLEAN)) && ($user->getImageName() !== '' and $user->getImageName() !== null)) {
            $fileUploader->delete('avatars/' . $user->getImageName());
            $user->setImageName('');
        }

        // Nouveau fichier ?
        if (array_key_exists("isNew", $file) && filter_var($file["isNew"], FILTER_VALIDATE_BOOLEAN)) {

            if ($user->getImageName() !== '' and $user->getImageName() !== null) {
                $fileUploader->delete('avatars/' . $user->getImageName());
                $user->setImageName('');
            }

            $newFile = $request->files->get('file')['binary'];
            $filenameInfo = $fileUploader->upload($newFile, 'avatars');
            $user->setImageName($filenameInfo['filename']);
        }

        $errors = $validator->validate($user);

        if (count($errors) > 0) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }
            return new JsonResponse(['success' => false, 'messages' => $messages]);
        }

        $this->manager->persist($user);
        $this->manager->flush();

        return new JsonResponse([
            'success' => true,
            'user' => $this->serializeData->getUserJson($user),
            'token' => $currentUser === $user ? $this->jwtManager->create($user) : null
        ]);
    }

    #[IsGranted('ROLE_SUPER_ADMIN', message: 'You are not allowed')]
    #[Route('delete-user/{token}', methods: ['DELETE'])]
    public function delete(User $user): JsonResponse
    {
        $this->manager->remove($user);
        $this->manager->flush();

        return new JsonResponse([
            'success' => true,
        ]);
    }
}
