<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QrCodeService
{
    protected string $uploadFolder = 'fileadmin/qr_codes/';

    /**
     * Generiert und speichert einen QR-Code für das Zertifikat
     * 
     * @param string $certificateCode Der Zertifikatscode, der im QR-Code codiert werden soll
     * @return string Der Pfad zum gespeicherten QR-Code-Bild
     */
    public function generateAndStoreQrCode(string $certificateCode): string
    {
        // Erstelle einen neuen QR-Code
        $qrCode = new QrCode($certificateCode);
        $qrCode->setSize(300);
        $qrCode->setMargin(10);

        // Verwende den PngWriter, um das Bild zu erzeugen
        $writer = new PngWriter();
        
        // Bestimme den Dateipfad, wo der QR-Code gespeichert wird
        $filePath = GeneralUtility::getFileAbsFileName($this->uploadFolder . $certificateCode . '.png');
        
        // Speichere das Bild auf dem Server
        $writer->writeFile($qrCode, $filePath);

        // Rückgabe des Dateipfades des QR-Codes
        return $filePath;
    }
}