<?php 

require_once __DIR__ . '/../bootstrap.php';

try {

    $container->authorization()
              ->validation()
              ->response();

} catch (\Exception $Exception) {
    $container->response()->json([
        'errors' => [],
        'message' => $Exception->getMessage(),
    ], 500);
}