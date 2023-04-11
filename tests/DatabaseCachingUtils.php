<?php

declare(strict_types=1);

namespace App\Tests;

use Symfony\Component\Finder\Finder;

class DatabaseCachingUtils
{
    public static function calculateDirectoriesHash(string ...$directories): string
    {
        $finder = new Finder();
        $finder = $finder->in($directories)->name('*.php')->files();
        $files = array_keys(iterator_to_array($finder->getIterator()));
        $hash = '';

        foreach ($files as $file) {
            $hash .= md5_file($file);
        }

        return $hash;
    }

    public static function isCacheUpToDate(string $cacheFilePath, string $currentDatabaseHash): bool
    {
        if (!file_exists($cacheFilePath)) {
            return false;
        }

        $cachedDatabaseHash = file_get_contents($cacheFilePath);
        $lastModificationTimestamp = filemtime($cacheFilePath);
        $cacheValidUntil = time() + 24 * 3600;

        if ($cacheValidUntil < $lastModificationTimestamp) {
            return false;
        }

        return $currentDatabaseHash === $cachedDatabaseHash;
    }
}
