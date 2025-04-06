<?php
namespace Vendor\EquedLms\Controller;

use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

class ErrorController extends ActionController
{
    /**
     * Zeigt die Zugriff verweigert Seite an.
     * Diese Aktion wird aufgerufen, wenn ein Benutzer auf eine geschützte Seite zugreift, 
     * ohne über die richtige Rolle zu verfügen.
     */
    public function accessDeniedAction()
    {
        // Diese Aktion rendert die 'access-denied' Seite
        // Die Fluid-Datei wird im Ordner Resources/Private/Templates/Error/access-denied.html erwartet
    }
}