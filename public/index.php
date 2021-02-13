<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use Arego\App\Application;
use Arego\App\Router\Route;
use Arego\App\Router\RouterFactory;
use Arego\App\ServiceProviders\EventDispatcherServiceProvider;
use Arego\App\ServiceProviders\HttpRouterServiceProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;
use League\Container\Container;
use League\Event\EventDispatcher;

$configAggregator = new ConfigAggregator([
    new PhpFileProvider('../config/*.php'),
]);

// Container

$container = new League\Container\Container;
$container->addServiceProvider(new HttpRouterServiceProvider());
$container->addServiceProvider(new EventDispatcherServiceProvider());

// Application

$app = new Application($configAggregator);

// https://container.thephpleague.com/3.x/
$app->useContainer($container);


// https://event.thephpleague.com/3.0/usage/
$app->useDispatcher();


$routesDefinition = [
    Route::get('/', \Arego\http\EventForm::class)->name('form'),
    Route::post('/event-form-handler', \Arego\http\EventFormHandler::class)->name('form/handler'),
];

// our custom router based on custom new lamina router and PSRs
$app->useRouter($routesDefinition);


// load SERVER, POST ,GET
// connect to db
// invoke all events
$app->bootstrap();

// just render output response
$app->run();
