<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';
require "services/OrderService.php";
require "services/ProductService.php";
require "services/UserService.php";


Flight::register("order_service", "OrderService");
Flight::register("product_service", "ProductService");
Flight::register("user_service", "UserService");
Flight::register('userDao', "UserDao");



require_once 'routes/OrderRoutes.php';
require_once 'routes/ProductRoutes.php';
require_once 'routes/UserRoutes.php';

// middleware method for login
Flight::route('/*', function () {
  $path = Flight::request()->url;
  if ($path == '/login' || $path == '/docs.json' || $path == '/test/*') {
      return true;
  }

  $headers = getallheaders();
  if (@!$headers['Authorization']) {
      Flight::json(["message" => "Authorization is missing"], 403);
      return false;
  } else {
      try {
          $decoded = (array)JWT::decode($headers['Authorization'], new Key(Config::JWT_SECRET(), 'HS256'));
          Flight::set('user', $decoded);
          return true;
      } catch (\Exception $e) {
          Flight::json(["message" => "Authorization token is not valid"], 403);
          return false;
      }
  }
});
  

Flight::route('GET /docs.json', function(){
    $openapi = \OpenApi\scan('routes');
    header('Content-Type: application/json');
    echo $openapi->toJson();
});

Flight::start();

?>