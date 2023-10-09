<?php
// Dynamic Url 
require_once(__DIR__ . '/../../DynamicUrlGenerator.php');

use App\Url;

session_start();
session_unset();
session_destroy();
header("location: " . Url::link('/index.php'));
