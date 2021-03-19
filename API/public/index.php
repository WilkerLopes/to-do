<?php

(require __DIR__ . '/../config/bootstrap.php')->run();

header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:X-Request-With');

header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
