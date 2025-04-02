#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Translation\Loader\XliffFileLoader;

$directory = $argv[1] ?? 'Resources/Private/Language/';
$errors = [];

$loader = new XliffFileLoader();
$rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

foreach ($rii as $file) {
    if (!$file->isFile() || !str_ends_with($file->getFilename(), '.xlf')) {
        continue;
    }

    $filePath = $file->getPathname();

    try {
        $catalogue = $loader->load($filePath, 'en');
        foreach ($catalogue->all() as $domain => $messages) {
            foreach ($messages as $key => $value) {
                if (trim($value) === '') {
                    $errors[] = "$filePath: [$domain] '$key' hat einen **leeren target-Eintrag**.";
                }
            }
        }
    } catch (Throwable $e) {
        $errors[] = "$filePath: Fehler beim Laden – " . $e->getMessage();
    }
}

if ($errors) {
    echo "🚨 Fehlerhafte Sprachdateien gefunden:\n";
    foreach ($errors as $e) {
        echo " - $e\n";
    }
    exit(1);
}

echo "✅ Alle Sprachdateien sind vollständig und gültig.\n";