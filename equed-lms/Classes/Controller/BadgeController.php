<?php

declare(strict_types=1);

namespace EquedLms\Controller;

use EquedLms\Domain\Model\Badge;
use EquedLms\Domain\Repository\BadgeRepository;
use Psr\Log\LoggerInterface;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class BadgeController extends ActionController
{
    protected BadgeRepository $badgeRepository;

    public function __construct(BadgeRepository $badgeRepository)
    {
        $this->badgeRepository = $badgeRepository;
    }

    public function listAction(): void
    {
        $items = $this->badgeRepository->findAll();
        $this->view->assign('badges', $items);
    }

    public function showAction(Badge $badge): void
    {
        $this->view->assign('badge', $badge);
    }

    public function createAction(Badge $badge): void
    {
        $this->badgeRepository->add($badge);
        $this->redirect('list');
    }

    public function updateAction(Badge $badge): void
    {
        $this->badgeRepository->update($badge);
        $this->redirect('list');
    }

    public function deleteAction(Badge $badge): void
    {
        $this->badgeRepository->remove($badge);
        $this->redirect('list');
    }
}