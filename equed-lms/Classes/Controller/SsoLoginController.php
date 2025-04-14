<?php

declare(strict_types=1);

namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Http\RedirectResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

class SsoLoginController extends ActionController
{
    /**
     * OAuth2 login service URL
     */
    private const OAUTH_LOGIN_URL = 'https://auth.equed.eu/login';

    /**
     * Callback after successful login
     */
    private const REDIRECT_URL = 'https://training.equed.eu/verify';

    public function __construct(
        protected readonly LoggerInterface $logger
    ) {}

    /**
     * Handles SSO login and redirects to the OAuth2 service
     */
    public function loginAction(): ResponseInterface
    {
        if ($GLOBALS['TSFE']->fe_user->user) {
            $this->logger->info('SSO skipped – user already logged in.', [
                'userId' => $GLOBALS['TSFE']->fe_user->user['uid'] ?? null
            ]);

            return new RedirectResponse(
                $this->uriBuilder->reset()->uriFor('dashboard', [], 'Dashboard')
            );
        }

        $authUrl = self::OAUTH_LOGIN_URL . '?redirect_uri=' . urlencode(self::REDIRECT_URL);

        $this->logger->info('Redirecting to OAuth2 login.', ['targetUrl' => $authUrl]);

        return new RedirectResponse($authUrl);
    }
}
