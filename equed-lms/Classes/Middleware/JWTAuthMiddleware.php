<?php
namespace Vendor\EquedLms\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Authentication\FrontendUserAuthentication;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use Firebase\JWT\JWT; // Stelle sicher, dass du die Firebase JWT-Bibliothek eingebunden hast
use TYPO3\CMS\Core\Utility\RootlineUtility;
use TYPO3\CMS\Core\Http\RequestFactory;

class JWTAuthMiddleware
{
    protected $jwtSecret;

    public function __construct()
    {
        // Hier kannst du die Konfiguration wie Secret oder Public Key definieren
        $this->jwtSecret = 'PY5IP0UOT5qntsErVbSclo/JTGJZVc58bfnACB50EpU='; // Dein Secret-Key hier
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        // Hole das Token aus der URL
        $token = $request->getQueryParams()['token'] ?? null;

        if ($token) {
            try {
                // JWT validieren
                $decoded = JWT::decode($token, $this->jwtSecret, ['HS256']);
                $userId = $decoded->user_id; // Extrahiere die User-ID aus dem Token

                // Benutzer anhand der ID suchen
                $userRepository = GeneralUtility::makeInstance(\TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository::class);
                $user = $userRepository->findByUid($userId);

                if ($user) {
                    // Benutzer im Frontend einloggen
                    $this->loginUser($user);

                    // Weiterleitung ins Dashboard (kann auch eine andere URL sein)
                    return $response->withHeader('Location', '/dashboard')->withStatus(302);
                } else {
                    throw new \Exception('User not found');
                }
            } catch (\Exception $e) {
                // Fehlerbehandlung: Ungültiges Token oder Benutzer nicht gefunden
                return $response->withStatus(401)->write('Unauthorized: ' . $e->getMessage());
            }
        }

        // Wenn kein Token übergeben wird, den nächsten Handler aufrufen
        return $next($request, $response);
    }

    protected function loginUser($user)
    {
        // Benutzer in die Frontend-Session einloggen
        /** @var FrontendUserAuthentication $feUser */
        $feUser = $GLOBALS['TSFE']->fe_user;
        $feUser->createUserSession($user);
    }
}
