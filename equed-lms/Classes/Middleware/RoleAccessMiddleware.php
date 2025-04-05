<?php

declare(strict_types=1);

namespace Equed\EquedLms\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Server\MiddlewareInterface;
use TYPO3\CMS\Core\Http\RedirectResponse;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository;
use Equed\EquedLms\Service\RoleService;

class RoleAccessMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $uri = rtrim($request->getUri()->getPath(), '/');

        $roleMap = include GeneralUtility::getFileAbsFileName(
            'EXT:equed_lms/Configuration/AccessControl/RoleRouteMap.php'
        );

        foreach ($roleMap as $protectedPath => $requiredRole) {
            if (str_starts_with($uri, $protectedPath)) {
                $feUser = $GLOBALS['TSFE']->fe_user ?? null;
                $userId = $feUser?->user['uid'] ?? null;

                if (!$userId) {
                    return new RedirectResponse('/login');
                }

                /** @var FrontendUserRepository $repo */
                $repo = GeneralUtility::makeInstance(FrontendUserRepository::class);
                $user = $repo->findByUid((int)$userId);

                /** @var RoleService $roleService */
                $roleService = GeneralUtility::makeInstance(RoleService::class);

                if (!$user || !$roleService->hasRole($user, $requiredRole)) {
                    return new RedirectResponse('/access-denied');
                }
            }
        }

        return $handler->handle($request);
    }
}