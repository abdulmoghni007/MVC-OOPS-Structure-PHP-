<?php

require_once 'vendor/autoload.php';

use App\Providers\Auth;
use App\Providers\Database;
use App\Providers\Router;

const DB = new Database();
const Auth = new Auth();

require_once 'config/cors.php';
require_once 'config/functions.php';
require_once 'api.php';

echo json_encode(Router::matchRoute());
