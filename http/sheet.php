<?php 

include_once 'bootstrap.php';

try {

    $rows = $container->database('mysql')
                      ->select([ 'email' ])
                      ->from('newsletters')
                      ->orderBy('email', 'ASC')
                      ->run();

    $container->response()->view('html/sheet', [
        'rows' => $rows
    ], 200);

} catch (\Exception $Exception) {

    $container->response()->json([
        'message' => $Exception->getMessage(),
    ], 500);
    
}
