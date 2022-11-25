<?php
require_once "vendor/autoload.php";

use DI\ContainerBuilder;
use App\Classes\App;

$containerBuilder = new ContainerBuilder();
$container = $containerBuilder->build();

$app = $container->get(App::class);
echo $app->run();
