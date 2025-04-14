<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\Material;
use EquedLms\Domain\Repository\MaterialRepository;
use EquedLms\Domain\Repository\LessonRepository;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;
use TYPO3\CMS\Core\Messaging\AbstractMessage;
use Psr\Log\LoggerInterface;
use Psr\Http\Message\ResponseInterface;

class MaterialController extends ActionController
{
    public function __construct(
        protected readonly MaterialRepository $materialRepository,
        protected readonly LessonRepository $lessonRepository,
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Lists all materials.
     */
    public function listAction(): ResponseInterface
    {
        $materials = $this->materialRepository->findAll();
        $this->view->assign('materials', $materials);

        $this->logger->info('Material list rendered.', ['count' => count($materials)]);
        return $this->htmlResponse();
    }

    /**
     * Shows a single material.
     */
    public function showAction(Material $material): ResponseInterface
    {
        $this->view->assign('material', $material);
        return $this->htmlResponse();
    }

    /**
     * Displays form to create a new material.
     */
    public function newAction(): ResponseInterface
    {
        $this->view->assign('lessons', $this->lessonRepository->findAll());
        return $this->htmlResponse();
    }

    /**
     * Creates a new material.
     */
    public function createAction(Material $material): ResponseInterface
    {
        $this->materialRepository->add($material);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.materialCreated', 'EquedLms')
                ?? 'Material created successfully.',
            '',
            AbstractMessage::OK
        );

        $this->logger->info('Material created.', ['id' => $material->getUid()]);
        return $this->redirect('list');
    }

    /**
     * Displays edit form for a material.
     */
    public function editAction(Material $material): ResponseInterface
    {
        $this->view->assignMultiple([
            'material' => $material,
            'lessons' => $this->lessonRepository->findAll()
        ]);
        return $this->htmlResponse();
    }

    /**
     * Updates an existing material.
     */
    public function updateAction(Material $material): ResponseInterface
    {
        $this->materialRepository->update($material);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.materialUpdated', 'EquedLms')
                ?? 'Material updated.',
            '',
            AbstractMessage::OK
        );

        $this->logger->info('Material updated.', ['id' => $material->getUid()]);
        return $this->redirect('list');
    }

    /**
     * Deletes a material.
     */
    public function deleteAction(Material $material): ResponseInterface
    {
        $this->materialRepository->remove($material);

        $this->addFlashMessage(
            LocalizationUtility::translate('flashMessages.materialDeleted', 'EquedLms')
                ?? 'Material deleted.',
            '',
            AbstractMessage::WARNING
        );

        $this->logger->warning('Material deleted.', ['id' => $material->getUid()]);
        return $this->redirect('list');
    }
}
