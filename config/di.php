<?php

declare(strict_types = 1);

use Blog\Database;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use function DI\autowire;
use function DI\get;

return array( // config for containers
    FilesystemLoader::class => autowire() // можливіть використання constructorParameter()
        ->constructorParameter('paths', 'templates'),

    Environment::class => autowire()
        ->constructorParameter('loader', get(FilesystemLoader::class)),

    Database::class => autowire()
    ->constructorParameter('dsn',getenv('DATABSE_DSN'))
    ->constructorParameter('username', getenv('DATABASE_USERNAME'))
    ->constructorParameter('password', getenv('DATABASE_PASSWORD'))
);