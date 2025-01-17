<?php

namespace App\Controller\Api;

use App\Entity\Project;
use App\Enum\ProjectTag;
use App\Repository\ProjectRepository;
use App\Service\FileUploaderService;
use App\Service\SerializeDataToJsonService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[IsGranted('ROLE_SUPER_ADMIN', message: 'Accès refusé. Vous devez être administrateur pour accéder à cette ressource')]
#[Route('/v1/project/')]
class ApiProjectController extends AbstractController
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
        $projects = $projectRepository->findAll();

        $data = array_map(fn($project) => $this->serializeData->getProjectJson($project, 'list'), $projects);

        return new JsonResponse([
            'success' => true,
            'projects' => $data
        ]);
    }

    #[Route('upsert', methods: ['POST'])]
    public function upsert(
        Request                     $request,
        FileUploaderService         $fileUploader,
        ValidatorInterface          $validator,
        ProjectRepository              $projectRepository,
    ): JsonResponse
    {
        $action = 'new';
        $token = $request->request->get('token', '');

        if ($token === '') {
            $project = new Project();
        } else {
            $action = 'edit';

            $project = $projectRepository->findOneBy(['token' => $token]);

            if (!$project) {
                return new JsonResponse(['success' => false, 'messages' => ["Projet non trouvé"]]);
            }
        }

        $project->setTitle($request->request->get('title'));
        $project->setDescription($request->request->get('description'));
        $project->setActive($request->request->getBoolean('active'));

        $tag = ProjectTag::tryFrom($request->request->get('tag'));

        if ($tag === null) {
            return new JsonResponse(['success' => false, 'messages' => ["Valeur de tag invalide"]]);
        }
        $project->setTag($tag);

        // test si on as un fichier
        $file = $request->request->all('file');

        if ($action === 'edit' && (array_key_exists("isDelete", $file) && filter_var($file["isDelete"], FILTER_VALIDATE_BOOLEAN)) && ($project->getImageName() !== '' and $project->getImageName() !== null)) {
            $fileUploader->delete('projects/' . $project->getImageName());
            $project->setImageName('');
        }

        // Nouveau fichier ?
        if (array_key_exists("isNew", $file) && filter_var($file["isNew"], FILTER_VALIDATE_BOOLEAN)) {

            if ($project->getImageName() !== '' and $project->getImageName() !== null) {
                $fileUploader->delete('projects/' . $project->getImageName());
                $project->setImageName('');
            }

            $newFile = $request->files->get('file')['binary'];
            $filenameInfo = $fileUploader->upload($newFile, 'projects');
            $project->setImageName($filenameInfo['filename']);
        }

        $errors = $validator->validate($project);

        if (count($errors) > 0) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[] = $error->getMessage();
            }
            return new JsonResponse(['success' => false, 'messages' => $messages]);
        }

        $this->manager->persist($project);
        $this->manager->flush();

        return new JsonResponse([
            'success' => true,
            'project' => $this->serializeData->getProjectJson($project),
        ]);
    }

    #[Route('delete-project/{token}', methods: ['DELETE'])]
    public function delete(Project $project): JsonResponse
    {
        $this->manager->remove($project);
        $this->manager->flush();

        return new JsonResponse([
            'success' => true,
        ]);
    }
}
