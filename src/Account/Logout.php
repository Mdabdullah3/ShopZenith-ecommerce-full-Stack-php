<?php
// Dynamic Url 
require_once(__DIR__ . '/../../DynamicUrlGenerator.php');
$urlGenerator = new DynamicUrlGenerator();
session_start();
session_unset();
session_destroy();
header("location: " . $urlGenerator->generateLink('/index.php'));
