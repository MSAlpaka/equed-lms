<?php
namespace Vendor\EquedLms\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use TYPO3\CMS\Core\Http\RedirectResponse;
use Vendor\EquedLms\Service\RoleService;

class RoleAccessMiddleware implements MiddlewareInterface
{
    /**
     * Verarbeitet die Anfrage und prüft den Benutzerzugriff basierend auf der Rolle
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uri = rtrim($request->getUri()->getPath(), '/');

        // Role-Route-Mapping aus Konfiguration laden
        $roleMap = include GeneralUtility::getFileAbsFileName(
            'EXT:equed_lms/Configuration/AccessControl/RoleRouteMap.php'
        );

        // Prüft, ob der aktuelle Pfad eine Rolle erfordert
        foreach ($roleMap as $protectedPath => $requiredRole) {
            if (str_starts_with($uri, $protectedPath)) {
                $feUser = $GLOBALS['TSFE']->fe_user ?? null;
                if (!$feUser || !$this->hasRequiredRole($feUser->user, $requiredRole)) {
                    // Zugriff verweigert, Umleitung auf "Access Denied"
                    return new RedirectResponse('/access-denied');
                }
            }
        }

        // Wenn alles passt, Anfrage weiterleiten
        return $handler->handle($request);
    }

    /**
     * Überprüft, ob der Benutzer die erforderliche Rolle hat
     */
    protected function hasRequiredRole($user, string $role): bool
    {
        // Prüft, ob der Benutzer die erforderliche Rolle hat (über Frontend-Benutzergruppen)
        return in_array($role, $user['usergroup']);
    }
}