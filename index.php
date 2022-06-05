<?php

use Blog\Route\AboutPage;
use Blog\Route\BlogPage;
use Blog\Route\PostPage;
use Blog\Route\HomePage;
use Blog\Slim\TwigMiddleware;
use DevCoder\DotEnv;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$builder = new ContainerBuilder();
$builder->addDefinitions('config/di.php');

(new DotEnv(__DIR__ .'/.env'))->load(); // database settings

$container = $builder->build();

AppFactory::setContainer($container);

// Create app
$app = AppFactory::create();

$app->add($container->get(TwigMiddleware::class));


// Add error middleware
$app->addErrorMiddleware(true, true, true);

// Add routes
$app->get('/posts', HomePage::class . ':execute');


$app->get('/about', AboutPage::class);

$app->get('/blog[/{page}]', BlogPage::class);

$app->get('/{url_key}', PostPage::class);

$app->run();