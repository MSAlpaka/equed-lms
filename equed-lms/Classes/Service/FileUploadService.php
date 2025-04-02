<?php

namespace Equed\EquedLms\Service;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\StorageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class FileUploadService
{
    /**
     * Upload a file to the system
     */
    public function uploadFile(string $filePath): File
    {
        // Logic to upload file and store it in the system
        $storage = GeneralUtility::makeInstance(StorageRepository::class)->findByUid(1); // Default storage
        return $storage->addFile($filePath, 'some-folder');
    }
}