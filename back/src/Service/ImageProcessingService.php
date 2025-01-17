<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageProcessingService
{
    /**
     * Vérifie si le fichier est une image valide supportée.
     *
     * @param UploadedFile $file Le fichier uploadé.
     * @return bool
     */
    public function isValidImage(UploadedFile $file): bool
    {
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        return in_array($file->getMimeType(), $allowedMimeTypes, true);
    }

    /**
     * Crée une ressource image à partir d'un fichier.
     *
     * @param string $filePath Le chemin vers le fichier image.
     * @return \GdImage La ressource image créée.
     * @throws \Exception Si le type d'image n'est pas pris en charge ou si la création échoue.
     */
    public function createImageResource(string $filePath): \GdImage
    {
        $imageType = exif_imagetype($filePath);

        switch ($imageType) {
            case IMAGETYPE_JPEG:
                $image = @imagecreatefromjpeg($filePath);
                break;
            case IMAGETYPE_PNG:
                $image = @imagecreatefrompng($filePath);
                break;
            case IMAGETYPE_GIF:
                $image = @imagecreatefromgif($filePath);
                break;
            case IMAGETYPE_WEBP:
                if (function_exists('imagecreatefromwebp')) {
                    $image = @imagecreatefromwebp($filePath);
                } else {
                    throw new \Exception('Le format WebP n\'est pas supporté sur ce serveur.');
                }
                break;
            default:
                throw new \Exception('Type d\'image non pris en charge.');
        }

        if (!$image) {
            throw new \Exception('Échec de la création de la ressource image.');
        }

        return $image;
    }

    /**
     * Sauvegarde une ressource image dans un fichier sur le disque.
     *
     * @param resource $image La ressource image à sauvegarder.
     * @param string $filePath Le chemin complet du fichier où sauvegarder l'image.
     * @param string $mimeType Le type MIME de l'image.
     * @return bool Retourne true si la sauvegarde a réussi, false sinon.
     * @throws \Exception Si le type MIME n'est pas pris en charge ou si la sauvegarde échoue.
     */
    public function saveImageResource($image, string $filePath, string $mimeType): bool
    {
        switch ($mimeType) {
            case 'image/jpeg':
                $result = imagejpeg($image, $filePath, 90); // Qualité JPEG à 90
                break;
            case 'image/png':
                imagealphablending($image, false);
                imagesavealpha($image, true);
                $result = imagepng($image, $filePath, 6); // Niveau de compression PNG à 6
                break;
            case 'image/gif':
                $result = imagegif($image, $filePath);
                break;
            case 'image/webp':
                if (function_exists('imagewebp')) {
                    $result = imagewebp($image, $filePath, 80); // Qualité WebP à 80
                } else {
                    throw new \Exception('Le format WebP n\'est pas supporté sur ce serveur.');
                }
                break;
            default:
                throw new \Exception('Type MIME non pris en charge.');
        }

        if (!$result || !file_exists($filePath)) {
            throw new \Exception('Échec de la sauvegarde de l\'image.');
        }

        // Vérifier l'intégrité de l'image sauvegardée
        try {
            $this->createImageResource($filePath);
        } catch (\Exception $e) {
            throw new \Exception('Image sauvegardée est corrompue.');
        }

        return true;
    }

    /**
     * Applique une rotation à une image si nécessaire, en fonction des métadonnées EXIF.
     *
     * @param UploadedFile $file Le fichier image uploadé.
     * @return \GdImage|false La ressource image potentiellement réorientée.
     * @throws \Exception Si le fichier n'est pas une image valide ou un type non supporté.
     */
    public function rotateImageIfNeeded(UploadedFile $file): \GdImage|false
    {
        // Validation du fichier
        if (!$this->isValidImage($file)) {
            throw new \Exception('Fichier image non valide ou type non supporté.');
        }

        // Lecture des métadonnées EXIF (nécessaire uniquement pour JPEG et TIFF)
        $exif = @exif_read_data($file->getPathname());

        // Création de la ressource image
        $image = $this->createImageResource($file->getPathname());

        // Application de la rotation si nécessaire
        if (!empty($exif['Orientation'])) {
            switch ($exif['Orientation']) {
                case 1:
                    // Orientation normale, aucune action
                    break;
                case 2:
                    // Retourner horizontalement
                    imageflip($image, IMG_FLIP_HORIZONTAL);
                    break;
                case 3:
                    // Rotation de 180 degrés
                    $image = imagerotate($image, 180, 0);
                    break;
                case 4:
                    // Retourner verticalement
                    imageflip($image, IMG_FLIP_VERTICAL);
                    break;
                case 5:
                    // Rotation de 270 degrés et retourner horizontalement
                    $image = imagerotate($image, 270, 0);
                    imageflip($image, IMG_FLIP_HORIZONTAL);
                    break;
                case 6:
                    // Rotation de 90 degrés dans le sens horaire
                    $image = imagerotate($image, -90, 0);
                    break;
                case 7:
                    // Rotation de 90 degrés et retourner horizontalement
                    $image = imagerotate($image, -90, 0);
                    imageflip($image, IMG_FLIP_HORIZONTAL);
                    break;
                case 8:
                    // Rotation de 90 degrés dans le sens antihoraire
                    $image = imagerotate($image, 90, 0);
                    break;
                default:
                    // Orientation non reconnue, aucune action
                    break;
            }
        }

        // Si l'image est PNG ou WebP, préserver la transparence après rotation
        $imageType = exif_imagetype($file->getPathname());
        if (in_array($imageType, [IMAGETYPE_PNG, IMAGETYPE_WEBP], true)) {
            imagealphablending($image, false);
            imagesavealpha($image, true);
        }

        return $image;
    }
}
