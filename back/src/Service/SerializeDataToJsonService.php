<?php
namespace App\Service;

use App\Entity\Project;
use App\Entity\User;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AttributeLoader;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SerializeDataToJsonService
{
    protected Serializer $serializer;
    protected string $frontUrl;

    public function __construct(
        CacheManager $imageCacheManager,
        string $frontUrl // Injection de la variable d'environnement FRONT_URL
    ) {
        $this->imageCacheManager = $imageCacheManager;
        $this->frontUrl = $frontUrl; // Variable injectée
        $classMetadataFactory = new ClassMetadataFactory(new AttributeLoader());
        $normalizer = [new ObjectNormalizer($classMetadataFactory)];
        $this->serializer = new Serializer($normalizer);
    }

    public function getUserJson(User $user, string $level = 'full'): array
    {
        $data = $this->serializer->normalize($user, null, ['groups' => $level]);

        $data["image"] = $this->getFilePath($data["imageName"], 'uploads/avatars/', 'thumb');

        if ($level === 'full' or $level === 'list') {
            $data["file"] = $this->getFileData($user->getImageName(), 'uploads/avatars/', 'thumb');
        }
        return $data;
    }

    public function getProjectJson(Project $project, string $level = 'full'): array
    {
        $data = $this->serializer->normalize($project, null, ['groups' => $level]);

        $data["image"] = $this->getFilePath($data["imageName"], 'uploads/projects/', 'quarttier');

        if ($level === 'full' or $level === 'list') {
            $data["file"] = $this->getFileData($project->getImageName(), 'uploads/projects/', 'quarttier');
        }

        $data['tag'] = $project->getTagValue();

        return $data;
    }

//    private function getFilePath(?string $imageName, string $uploadDir, string $filter): string
//    {
//        // Vérifie si $imageName est défini et non vide
//        if ($imageName !== '' && $imageName !== null) {
//            $url = $this->imageCacheManager->getBrowserPath($uploadDir . $imageName, $filter);
//
//            // Remplace 'http://nginx' par l'URL définie dans l'environnement
//            return str_replace('https://nginx', $this->frontUrl, $url);
//        }
//
//        // Retourne une chaîne vide si $imageName est null ou vide
//        return '';
//    }

    private function getFilePath(?string $imageName, string $uploadDir, string $filter): string
    {
        // Vérifie si $imageName est défini et non vide
        if ($imageName !== '' && $imageName !== null) {
            $url = $this->imageCacheManager->getBrowserPath($uploadDir . $imageName, $filter);

            // Si l'URL générée contient 'https://nginx', remplace par $this->frontUrl
            if (strpos($url, 'https://nginx') !== false) {
                $url = str_replace('https://nginx', $this->frontUrl, $url);
            }

            // Assure-toi que l'URL utilise HTTPS
            return preg_replace('/^http:/', 'https:', $url);
        }

        // Retourne une chaîne vide si $imageName est null ou vide
        return '';
    }


    private function getFileData(?string $imageName, string $uploadDir, string $filter): array
    {
        return [
            "name" => $imageName,
            "type" => "",
            "extension" => "",
            "isImage" => true,
            "url" => $this->getFilePath($imageName, $uploadDir, $filter),
            "isUploaded" => ($imageName !== '' && $imageName !== null),
            "isNew" => false,
            "isEditable" => true
        ];
    }
}