<?php

declare(strict_types=1);

namespace Equed\EquedLms\Service;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Component\HttpFoundation\Response;

/**
 * Service to generate QR codes for certificates or URLs
 */
class QrCodeService
{
    /**
     * Generate a QR code for a certificate or URL
     *
     * @param string $content The content for the QR code (e.g. URL or certificate ID)
     * @return string The generated QR code as a PNG image data
     */
    public function generateQrCode(string $content): string
    {
        $qrCode = new QrCode($content);
        $writer = new PngWriter();

        // Generate the QR code and return the binary PNG data
        return $writer->writeString($qrCode);
    }

    /**
     * Output the QR code as an HTTP response (for direct file download)
     *
     * @param string $content
     * @return Response
     */
    public function outputQrCode(string $content): Response
    {
        $qrCodeImage = $this->generateQrCode($content);

        return new Response(
            $qrCodeImage,
            Response::HTTP_OK,
            ['Content-Type' => 'image/png']
        );
    }
}