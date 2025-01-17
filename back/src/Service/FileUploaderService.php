<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploaderService
{
    private string $targetDirectory;
    private string $webPathUpload;
    private ImageProcessingService $imageProcessing; // Ajout du service de traitement des images
    private SluggerInterface $slugger; // Ajout de cette ligne

    /**
     * Le service ImageProcessingService est injecté pour gérer la rotation et le traitement des images.
     */
    public function __construct(
        string $defaultTargetDirectory,
        string $webPathUpload,
        SluggerInterface $slugger,
        ImageProcessingService $imageProcessing
    ) {
        $this->targetDirectory = rtrim($defaultTargetDirectory, '/') . '/';
        $this->webPathUpload = rtrim($webPathUpload, '/') . '/';
        $this->slugger = $slugger;
        $this->imageProcessing = $imageProcessing; // Injection du service de traitement des images
    }

    /**
     * Méthode pour uploader un fichier, avec un répertoire cible optionnel.
     * Si le fichier est une image, le service ImageProcessingService est utilisé pour appliquer une rotation en fonction des métadonnées EXIF.
     *
     * @param UploadedFile $file Le fichier à uploader
     * @param string $targetDir Le répertoire de destination (optionnel)
     * @return array|null Retourne un tableau avec les informations du fichier uploadé (url et nom de fichier), ou null en cas d'erreur
     * @throws \Exception
     */
    public function upload(UploadedFile $file, string $targetDir = ''): ?array
    {
        $filesystem = new Filesystem();

        // Déterminer le chemin de destination final
        $finalTargetDirectory = $this->targetDirectory;

        if (!empty($targetDir)) {
            $finalTargetDirectory .= trim($targetDir, '/') . '/';
        }

        // Créer le répertoire s'il n'existe pas
        if (!$filesystem->exists($finalTargetDirectory)) {
            $filesystem->mkdir($finalTargetDirectory, 0755);
        }

        // Générer un nom de fichier unique et slugifié
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = strtolower($this->slugger->slug($originalFilename));
        $uniqueFilename = uniqid() . '-' . $safeFilename . '.' . $file->guessExtension();

        // Liste des types MIME supportés comme images
        $imageMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        // Vérification si le fichier est une image
        if (in_array($file->getMimeType(), $imageMimeTypes, true)) {
            // Utiliser ImageProcessingService pour gérer la rotation et la sauvegarde
            $image = $this->imageProcessing->rotateImageIfNeeded($file);

            // Définir le chemin complet de destination
            $destinationPath = $finalTargetDirectory . $uniqueFilename;

            // Sauvegarder l'image traitée
            $this->imageProcessing->saveImageResource($image, $destinationPath, $file->getMimeType());

            // Libérer la ressource image
            imagedestroy($image);
        } else {
            // Si ce n'est pas une image, déplacer simplement le fichier
            try {
                $file->move($finalTargetDirectory, $uniqueFilename);
            } catch (\Exception $e) {
                throw new \Exception('Erreur lors du déplacement du fichier : ' . $e->getMessage());
            }
        }

        // Construire l'URL du fichier uploadé
        $relativePath = ltrim(str_replace($this->targetDirectory, '', $finalTargetDirectory), '/');
        $fileUrl = $this->webPathUpload . ($relativePath ? $relativePath . '/' : '') . $uniqueFilename;

        // Retourner les informations du fichier uploadé
        return [
            'url' => $fileUrl,
            'filename' => $uniqueFilename
        ];
    }

    /**
     * Méthode pour supprimer un fichier.
     * Cette méthode utilise Filesystem pour supprimer le fichier situé à l'URL donnée.
     *
     * @param string $url L'URL du fichier à supprimer
     * @return void
     */
    public function delete(string $url): void
    {
        $filesystem = new Filesystem();
        $filePath = $this->targetDirectory . ltrim(str_replace($this->webPathUpload, '', $url), '/');
        $filesystem->remove($filePath);
    }

    /**
     * Méthode pour supprimer plusieurs fichiers en une seule opération.
     * Cette méthode boucle sur chaque URL de fichier et utilise Filesystem pour les supprimer.
     *
     * @param array $urls Tableau des URLs des fichiers à supprimer
     * @return void
     */
    public function deleteFiles(array $urls): void
    {
        $filesystem = new Filesystem();
        $filePaths = [];

        foreach ($urls as $url) {
            $filePath = $this->targetDirectory . ltrim(str_replace($this->webPathUpload, '', $url), '/');
            $filePaths[] = $filePath;
        }

        $filesystem->remove($filePaths);
    }
}
