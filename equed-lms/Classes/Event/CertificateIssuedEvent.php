<?php

declare(strict_types=1);

namespace Equed\EquedLms\Event;

final class CertificateIssuedEvent
{
    public function __construct(
        public readonly int $userId,
        public readonly int $courseId,
        public readonly string $pdfPath
    ) {}
}