<?php 

return [

    'smtp' => [
        // attribute
        'SMTPDebug' => 0,
        'CharSet' => 'UTF-8',
        'IsHTML' => [ true ],
        'setFrom' => [
            'noreply@rbsteel.com.br', 'RBSteel'
            // 'noreply@rbsteel.com.br', 'RBSteel*123'

        ],
        'addAddress' => [
            [ 'marketing@rbsteel.com.br', 'Atendimento ao Cliente', ],
            // [ 'murilo@2up.com.br', 'Atendimento ao Cliente', ],
        ],
        // driver
        'provider' => PHPMailer\PHPMailer\PHPMailer::class,
    ],
    
];