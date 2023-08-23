<?php 

include_once 'bootstrap.php';

try {

    $settings = $container->settings('mail') ->find('smtp');

    $request = $container->request()->post([
        'nome', 'email', 'telefone', 'convenio', 'data', 'periodo', 'exame'
    ]);

    if ( $mailer = mailer($settings) ) {

        $mailer->Subject = 'Agendamento Online - Site';
        $mailer->replyTo = $request['email'];
        $mailer->Body = $container->template (
            'mail/contact', $request
        );
        
        if( $fileAttach = $container->request()->upload('fileAttach') ) {
            $fileTemp   = $fileAttach->getFilesUploads();
            if( isset($fileTemp['tmp_name']) && isset($fileTemp['name']) ) {
                $mailer->AddAttachment($fileTemp['tmp_name'], $fileTemp['name']);
            }
        }
        
        if( !$mailer->Send() ) {
            throw new \Exception($mailer->ErrorInfo);
        }

        $container->response()->json([
            'message' => 'Enviado com sucesso',
        ], 200);
        
    }

    throw new \Exception("Tente novamente mais tarde");

} catch (\Exception $Exception) {

    $container->response()->json([
        'message' => $Exception->getMessage(),
    ], 500);
    
}