<?php
declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Mvc\View\JsonView;
use TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager;
use Equed\EquedLms\Domain\Model\CourseCertificate;
use Equed\EquedLms\Domain\Repository\CourseCertificateRepository;
use Equed\EquedLms\Domain\Model\FrontendUser;

class CertificateController extends ActionController
{
    protected CourseCertificateRepository $certificateRepository;
    protected PersistenceManager $persistenceManager;

    public function __construct(
        CourseCertificateRepository $certificateRepository,
        PersistenceManager $persistenceManager
    ) {
        $this->certificateRepository = $certificateRepository;
        $this->persistenceManager = $persistenceManager;
    }

    /**
     * Zeigt alle Zertifikate eines Nutzers
     */
    public function listForUserAction(): ResponseInterface
    {
        $user = $this->getCurrentUser();
        $certificates = $this->certificateRepository->findByUser($user);
        return $this->jsonResponse($certificates);
    }

    /**
     * Zertifikat ausstellen
     */
    public function issueAction(array $data): ResponseInterface
    {
        $certificate = GeneralUtility::makeInstance(CourseCertificate::class);
        $certificate->setUser($this->getCurrentUser());
        $certificate->setCourseInstanceUid((int)$data['courseInstanceUid']);
        $certificate->setCertificateCode($this->generateCode());
        $certificate->setStatus('issued');
        $certificate->setIsValid(true);
        $certificate->setVisibleForUser(true);
        $certificate->setIssuedAt(new \DateTime());
        $certificate->setIssuedBy($this->getCurrentUser());
        $certificate->setUuid($this->generateUuid());

        $this->certificateRepository->add($certificate);
        $this->persistenceManager->persistAll();

        return $this->jsonResponse(['success' => true, 'certificateId' => $certificate->getUid()]);
    }

    /**
     * Zertifikat validieren (Certifier)
     */
    public function validateAction(int $certificateId): ResponseInterface
    {
        $certificate = $this->certificateRepository->findByIdentifier($certificateId);
        if (!$certificate) {
            return $this->jsonResponse(['error' => 'Certificate not found'], 404);
        }

        $certificate->setValidatedAt(new \DateTime());
        $certificate->setValidatedBy($this->getCurrentUser());
        $this->certificateRepository->update($certificate);
        $this->persistenceManager->persistAll();

        return $this->jsonResponse(['success' => true]);
    }

    /**
     * Sichtbarkeit für Nutzer ändern
     */
    public function toggleVisibilityAction(int $certificateId, bool $visible): ResponseInterface
    {
        $certificate = $this->certificateRepository->findByIdentifier($certificateId);
        if (!$certificate) {
            return $this->jsonResponse(['error' => 'Certificate not found'], 404);
        }

        $certificate->setVisibleForUser($visible);
        $this->certificateRepository->update($certificate);
        $this->persistenceManager->persistAll();

        return $this->jsonResponse(['success' => true]);
    }

    /**
     * Prüfungscode öffentlich validieren (z. B. über QR)
     */
    public function verifyCodeAction(string $code): ResponseInterface
    {
        $certificate = $this->certificateRepository->findOneByCertificateCode($code);
        if (!$certificate || !$certificate->isValid()) {
            return $this->jsonResponse(['valid' => false], 404);
        }

        return $this->jsonResponse([
            'valid' => true,
            'userName' => $certificate->getUser()->getFullName(),
            'course' => $certificate->getCourseInstance()?->getTitle(),
            'issuedAt' => $certificate->getIssuedAt()?->format('Y-m-d'),
        ]);
    }

    /**
     * Setzt den Versandstatus
     */
    public function dispatchAction(int $certificateId, string $pdfUrl): ResponseInterface
    {
        $certificate = $this->certificateRepository->findByIdentifier($certificateId);
        if (!$certificate) {
            return $this->jsonResponse(['error' => 'Certificate not found'], 404);
        }

        $certificate->setDispatchedAt(new \DateTime());
        $certificate->setPdfUrl($pdfUrl);
        $certificate->setDispatchedBy($this->getCurrentUser());

        $this->certificateRepository->update($certificate);
        $this->persistenceManager->persistAll();

        return $this->jsonResponse(['success' => true]);
    }

    /**
     * JSON helper
     */
    protected function jsonResponse($data, int $status = 200): ResponseInterface
    {
        $view = GeneralUtility::makeInstance(JsonView::class);
        $view->assign('value', $data);
        $response = $this->responseFactory->createResponse($status);
        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json');
    }

    protected function getCurrentUser(): ?FrontendUser
    {
        return $GLOBALS['TSFE']->fe_user->user['uid']
            ? $this->objectManager->get(\Equed\EquedLms\Domain\Repository\FrontendUserRepository::class)->findByUid(
                (int)$GLOBALS['TSFE']->fe_user->user['uid']
            )
            : null;
    }

    protected function generateCode(): string
    {
        return strtoupper('EQ' . uniqid() . date('Ymd'));
    }

    protected function generateUuid(): string
    {
        return bin2hex(random_bytes(16));
    }
}

