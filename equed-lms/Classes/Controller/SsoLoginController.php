<?php
namespace Equed\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Http\RedirectResponse;

class SsoLoginController extends ActionController
{
    /**
     * OAuth2 service URL
     * (könnte auch per config eingebunden werden)
     */
    private const OAUTH_LOGIN_URL = 'https://auth.equed.eu/login';

    /**
     * Redirect URL nach erfolgreicher Authentifizierung
     */
    private const REDIRECT_URL = 'https://training.equed.eu/verify';

    /**
     * Handle the SSO login process
     */
    public function loginAction(): ResponseInterface
    {
        // Prüfen, ob User bereits eingeloggt ist
        if ($GLOBALS['TSFE']->fe_user->user) {
            return new RedirectResponse($this->uriBuilder->uriFor('dashboard', [], 'Dashboard'));
        }

        // URL für OAuth-Login erzeugen und weiterleiten
        $authUrl = self::OAUTH_LOGIN_URL . '?redirect_uri=' . urlencode(self::REDIRECT_URL);

        return new RedirectResponse($authUrl);
    }
}