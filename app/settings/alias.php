<?php

return [

    /*
     | Container da aplicação, usado para carregar
     | as dependências do sistema
     */
    'Container' => App\Core\Utils\Container::class,

    /*
     | Alias para as facades dos sistema
     */ 
    'JWToken'   => App\Core\Facade\JWToken::class,
    'Request'   => App\Core\Facade\Request::class,
    'Response'  => App\Core\Facade\Response::class,
    'Database'  => App\Core\Facade\Database::class,
    'Settings'  => App\Core\Facade\Settings::class,
    'Template'  => App\Core\Facade\Template::class,
    'Validator' => App\Core\Facade\Validator::class,

    /*
     | Classes importantes do core da aplicação 
     */
    'Collection' => App\Core\Utils\Collection::class,
    'PHPInicialize' => App\Core\Utils\PHPInicialize::class,

    /*
     | Classes de middleware
     */
    'Authorization' => App\Middleware\Authorization::class,
    
];