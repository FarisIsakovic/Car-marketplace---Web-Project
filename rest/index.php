<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
require "services/OrderService.php";
require "services/ProductService.php";
require "services/UserService.php";
require "services/ServiceService.php";



Flight::register("order_service", "OrderService");
Flight::register("product_service", "ProductService");
Flight::register("user_service", "UserService");
Flight::register("service_service", "ServiceService");


require_once 'routes/OrderRoutes.php';
require_once 'routes/ProductRoutes.php';
require_once 'routes/UserRoutes.php';
require_once 'routes/ServicesRoutes.php';

Flight::start();

?>