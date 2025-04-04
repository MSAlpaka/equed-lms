<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\ContentPage;
use EquedLms\Domain\Repository\ContentPageRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ContentPageController extends ActionController
{
    protected ContentPageRepository $contentPageRepository;

    public function __construct(ContentPageRepository $contentPageRepository)
    {
        $this->contentPageRepository = $contentPageRepository;
    }

    public function listAction(): void
    {
        $items = $this->contentPageRepository->findAll();
        $this->view->assign('contentPages', $items);
    }

    public function showAction(ContentPage $contentPage): void
    {
        $this->view->assign('contentPage', $contentPage);
    }

    public function createAction(ContentPage $contentPage): void
    {
        $this->contentPageRepository->add($contentPage);
        $this->redirect('list');
    }

    public function updateAction(ContentPage $contentPage): void
    {
        $this->contentPageRepository->update($contentPage);
        $this->redirect('list');
    }

    public function deleteAction(ContentPage $contentPage): void
    {
        $this->contentPageRepository->remove($contentPage);
        $this->redirect('list');
    }
}