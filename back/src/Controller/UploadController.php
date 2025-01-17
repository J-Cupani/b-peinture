<?php

namespace App\Controller;

use App\Service\FileUploaderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Class UploadController
 *
 * @package App\Controller\Admin
 */
class UploadController extends AbstractController
{
    public function __construct(private readonly FileUploaderService $fileUploader)
    {
    }

    /**
     * Permet l'upload de fichier
     *
     *
     * @return JsonResponse
     */
    #[Route(path: 'upload-files/{upload-files}', name: 'admin_upload', defaults: [
        'targetDir' => null
    ])]
    public function uploadFile(string $targetDir, Request $request): JsonResponse
    {
        //On lance le stockage
        $filenameInfo = $this->fileUploader->upload($request->files->get('files'), $targetDir);

        //Renvoi du nom de fichier stocké
        if ($filenameInfo['filename']) {
            return $this->json([
                'status' => true,
                'url' => $filenameInfo['url'],
                'filename' => $filenameInfo['filename']
            ], Response::HTTP_OK);
        }
        return $this->json(['status' => false], Response::HTTP_BAD_REQUEST);
    }

    # Permet le download de fichier
    #[Route(path: 'download-files/{filepath}', name: 'admin_download', requirements: [
        'filepath' => ".+"
    ])]
    public function downloadFile(string $filepath): Response
    {
        // Generate response
        $response = new Response();

        $filename = __DIR__ . "/../../documents/" . $filepath;

// Set headers
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-type', mime_content_type($filename));
        $response->headers->set('Content-Disposition', 'attachment; filename="' . basename($filename) . '";');
        $response->headers->set('Content-length', intval(filesize($filename)));

// Send headers before outputting anything
        $response->sendHeaders();

        $response->setContent(file_get_contents($filename));

        return $response;
    }
}