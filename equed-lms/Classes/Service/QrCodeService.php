<?php

namespace Equed\EquedLms\Service;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeService
{
    /**
     * Generate a QR code for a certificate or URL
     */
    public function generateQrCode(string $content): string
    {
        $qrCode = new QrCode($content);
        $writer = new PngWriter();
        
        // Save the QR code as a PNG file
        return $writer->writeFileToString($qrCode);
    }
}