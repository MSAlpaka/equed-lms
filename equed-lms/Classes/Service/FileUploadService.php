<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use TYPO3\CMS\Core\Resource\File;
use TYPO3\CMS\Core\Resource\Folder;
use TYPO3\CMS\Core\Resource\ResourceStorage;
use TYPO3\CMS\Core\Resource\StorageRepository;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Service for handling file uploads
 */
class FileUploadService
{
    private ResourceStorage $storage;

    public function __construct()
    {
        /** @var StorageRepository $storageRepo */
        $storageRepo = GeneralUtility::makeInstance(StorageRepository::class);
        $this->storage = $storageRepo->findByUid(1); // Default storage
    }

    /**
     * Upload a file to a given folder in default storage
     *
     * @param string $filePath Absolute file path
     * @param string $targetFolder Relative folder path in storage
     * @return File
     */
    public function uploadFile(string $filePath, string $targetFolder = '_temp_/uploads'): File
    {
        if (!is_file($filePath)) {
            throw new \InvalidArgumentException("File not found: $filePath");
        }

        /** @var Folder $folder */
        $folder = $this->storage->getFolder($targetFolder) ?: $this->storage->createFolder($targetFolder);

        return $this->storage->addFile(
            $filePath,
            $folder,
            basename($filePath),
            \TYPO3\CMS\Core\Resource\DuplicationBehavior::RENAME
        );
    }
}