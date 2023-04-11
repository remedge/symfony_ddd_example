<?php

declare(strict_types=1);

namespace App\Tests;

use App\Shared\Infrastructure\Symfony\Kernel;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Finder\Finder;

class TestBootstrapHelper
{
    public const DATABASE_CACHE_FILE = '/.database.cache';

    public const MIGRATIONS_PATH = '/../migrations';

    public static function createApplication(): Application
    {
        $kernel = new Kernel('test', true);
        $kernel->boot();

        $application = new Application($kernel);
        $application->setAutoExit(false);

        return $application;
    }

    public static function databaseSetup(Application $application): void
    {
        $application->run(new ArrayInput(
            [
                'command' => 'doctrine:database:drop',
                '--if-exists' => 1,
                '--force' => 1,
            ]
        ));

        $application->run(new ArrayInput(
            [
                'command' => 'doctrine:database:create',
            ]
        ));

        $application->run(new ArrayInput(
            [
                'command' => 'doctrine:migrations:migrate',
                '--allow-no-migration' => 1,
                '--no-interaction' => 1,
                '--all-or-nothing' => 1,
                '--quiet' => 1,
            ]
        ));

        $application->run(new ArrayInput(
            [
                'command' => 'doctrine:fixtures:load',
                '--no-interaction' => 1,
            ]
        ));
    }

    public static function miscellaneous(Application $application): void
    {
        $application->run(new ArrayInput(
            [
                'command' => 'cache:clear',
            ]
        ));
    }

    /**
     * @return array<string>
     */
    public static function getAllFixturesPaths(string $dir): array
    {
        $finder = new Finder();
        $finder->in($dir . '/../src')->name('*Fixtures.php')->files();

        $results = [];
        foreach ($finder->getIterator() as $item) {
            $results[] = $item->getPath();
        }

        return array_unique($results);
    }
}
