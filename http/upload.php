<?php

include_once 'bootstrap.php';

try {

    if( $upload = $container->request()->upload('files') ) {

        $directory = realpath(__DIR__ . '/../app/storage/uploads');

        if( !$upload->getCountTotalOfFiles() ) {
            $container->response()->json([
                'errors' => [],
                'message' => 'Faça o upload de pelo menos 1 arquivo',
            ], 422);
        }
        
        $upload->moveToDirectory( $directory );
    
        $container->response()->json([
            'message' => 'Fim do upload, enviado com sucesso',
        ], 200);

    }

    throw new \Exception("Tente novamente mais tarde");

} catch (\Exception $Exception) {

    $container->response()->json([
        'message' => $Exception->getMessage(),
    ], 500);

}