<?php

declare(strict_types=1);

namespace Equed\EquedLms\Domain\Model;

use TYPO3\CMS\Extbase\Domain\Model\FrontendUser;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

class User extends FrontendUser
{
    /**
     * @var bool|null
     */
    protected $isCertifier = null;

    /**
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference|null
     */
    protected $photo = null;

    /**
     * @return bool|null
     */
    public function getIsCertifier(): ?bool
    {
        return $this->isCertifier;
    }

    /**
     * @param bool|null $isCertifier
     */
    public function setIsCertifier(?bool $isCertifier): void
    {
        $this->isCertifier = $isCertifier;
    }

    /**
     * @return FileReference|null
     */
    public function getPhoto(): ?FileReference
    {
        return $this->photo;
    }

    /**
     * @param FileReference|null $photo
     */
    public function setPhoto(?FileReference $photo): void
    {
        $this->photo = $photo;
    }
}