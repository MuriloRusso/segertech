<?php 

include_once 'bootstrap.php';

try {

    if( $path = $container->request()->field('file') ) {
        $path = strtolower($path);
        $path = str_replace('..', '', $path);
    }

    if( $path ) {

        $realpath = realpath(__DIR__ . "/../app/storage/{$path}");

        if(file_exists($realpath)) {
            $container->response()
                      ->download($realpath);
        }

    }

    $container->response()
              ->text('File not found', 404);

} catch (\Exception $Exception) {

    $container->response()
              ->text($Exception->getMessage(), 500);

}
