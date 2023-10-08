<?php
session_start();
session_unset();
session_destroy();
header("Location: /New%20projects/index.php");
