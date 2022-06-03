<?php

declare(strict_types = 1);

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use function DI\autowire;
use function DI\get;

return array( // config for cont
    FilesystemLoader::class => autowire() // можливіть використання constructorParameter()
        ->constructorParameter('paths', 'templates'),

    Environment::class => autowire()
        ->constructorParameter('loader', get(FilesystemLoader::class))

);